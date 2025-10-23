<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use App\Http\Controllers\ActivityLogController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;

class TeacherController extends Controller
{
    // List all teachers
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        return view('teacher.index', compact('teachers'));
    }

    // Show create form
    public function create()
    {
        return view('teacher.create');
    }

    // Store new teacher
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:6',
            'subject' => 'required|string|max:255',
            'phone' => 'nullable|string|max:20',
            'date_of_birth' => 'nullable|date',
            'gender' => 'nullable|string|max:10',
            'village' => 'nullable|string|max:255',
            'commune' => 'nullable|string|max:255',
            'district' => 'nullable|string|max:255',
            'province' => 'nullable|string|max:255',
            'class_assigned' => 'nullable|string|max:50',
        ]);

        // Create user
        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        // Create teacher
        $teacher = Teacher::create(array_merge($validated, ['user_id' => $user->id]));

        // Assign teacher role
        $teacherRole = Role::where('name', 'teacher')->first();
        if ($teacherRole && !$user->roles()->where('role_id', $teacherRole->id)->exists()) {
            $user->roles()->attach($teacherRole);
        }

        
        $teacher->load('user');

      
        ActivityLogController::log(
            'create_teacher',
            'Created teacher: ' . $teacher->user->name,
            null,
            $teacher->toArray()
        );
        // dd($teacher->toArray());


        return redirect()->route('teacher.index')->with('success', 'Teacher added successfully!');
    }

    // Show edit form
    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    // Update teacher
public function update(Request $request, Teacher $teacher)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'email' => 'required|email|unique:users,email,' . $teacher->user->id,
        'password' => 'nullable|string|min:6',
        'subject' => 'required|string|max:255',
        'phone' => 'nullable|string|max:20',
        'date_of_birth' => 'nullable|date',
        'gender' => 'nullable|string|max:10',
        'village' => 'nullable|string|max:255',
        'commune' => 'nullable|string|max:255',
        'district' => 'nullable|string|max:255',
        'province' => 'nullable|string|max:255',
        'class_assigned' => 'nullable|string|max:50',
    ]);

   
    $oldValues = $teacher->load('user')->toArray();
    // dd($oldValues);

    // Update user
    $userData = [
        'name' => $validated['name'],
        'email' => $validated['email'],
    ];
    if (!empty($validated['password'])) {
        $userData['password'] = Hash::make($validated['password']);
    }
    $teacher->user->update($userData);
     $teacher->update([
    'subject' => $validated['subject'],
    'phone' => $validated['phone'] ?? null,
    'date_of_birth' => $validated['date_of_birth'] ?? null,
    'gender' => $validated['gender'] ?? null,
    'village' => $validated['village'] ?? null,
    'commune' => $validated['commune'] ?? null,
    'district' => $validated['district'] ?? null,
    'province' => $validated['province'] ?? null,
    'class_assigned' => $validated['class_assigned'] ?? null,
]);

  
  
    $teacher->refresh(); 
    $newValues = $teacher->load('user')->toArray();
    

    // Log activity
    ActivityLogController::log(
        'update_teacher',
        'Updated teacher: ' . $teacher->user->name,
        $oldValues,
        $newValues
    );

    return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully!');
}
    // Delete teacher
    public function destroy(Request $request, Teacher $teacher)
    {
        $oldValues = $teacher->load('user')->toArray();
        $teacherName = $teacher->user->name;

        $teacher->user->delete();
        $teacher->delete();

        ActivityLogController::log(
            'delete_teacher',
            'Deleted teacher: ' . $teacherName,
            $oldValues,
            null
        );

        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
    }

    // Edit permissions
    public function editPermissions($userId)
    {
        $user = User::with('permissions')->findOrFail($userId);
        $permissions = Permission::all();
        $userPermissions = $user->permissions->pluck('id')->toArray();

        return view('users.permissions.edit', compact('user', 'permissions', 'userPermissions'));
    }

    // Update permissions
    public function updatePermissions(Request $request, $userId)
    {
        $user = User::findOrFail($userId);

        // Old permissions
        $oldValues = $user->permissions->pluck('id')->toArray();

        $user->permissions()->sync($request->input('permissions', []));

        // New permissions
        $newValues = $user->permissions->pluck('id')->toArray();

        ActivityLogController::log(
            'update_teacher_permissions',
            'Updated permissions for teacher: ' . $user->name,
            $oldValues,
            $newValues
        );

        return redirect()->route('teacher.index')->with('success', 'Permissions updated successfully!');
    }
}
