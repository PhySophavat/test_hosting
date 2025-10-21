<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use App\Models\User;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ActivityLogController;

class TeacherController extends Controller
{
    /**
     * Display a listing of teachers.
     */
    public function index()
    {
        $teachers = Teacher::with('user')->get();
        return view('teacher.index', compact('teachers'));
    }

    /**
     * Show the form for creating a new teacher.
     */
    public function create()
    {
        return view('teacher.create');
    }

    /**
     * Store a newly created teacher.
     */
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

        // Assign role
        $teacherRole = Role::where('name', 'teacher')->first();
        if ($teacherRole && !$user->roles()->where('role_id', $teacherRole->id)->exists()) {
            $user->roles()->attach($teacherRole);
        }

        // Log activity
        app(ActivityLogController::class)->log(
            'Teacher Created',
            'Created teacher: ' . $validated['name'] . ' (ID: ' . $teacher->id . ')',
            'Teacher',
            $teacher->id
        );

        return redirect()->route('teacher.index')->with('success', 'Teacher added successfully!');
    }

    /**
     * Show the form for editing a teacher.
     */
    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    /**
     * Update the specified teacher.
     */
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

        // Update user
        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];
        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }
        $teacher->user->update($userData);

        // Update teacher
        $teacher->update($validated);

        // Log activity
        app(ActivityLogController::class)->log(
            'Teacher Updated',
            'Updated teacher: ' . $validated['name'] . ' (ID: ' . $teacher->id . ')',
            'Teacher',
            $teacher->id
        );

        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully!');
    }

    /**
     * Remove the specified teacher.
     */
    public function destroy(Teacher $teacher)
    {
        $teacherId = $teacher->id;
        $teacherName = $teacher->user->name;
        $userId = $teacher->user->id;

        // Delete user and teacher
        $teacher->user->delete();
        $teacher->delete();
        
        // Log activity
        app(ActivityLogController::class)->log(
            'Teacher Deleted',
            'Deleted teacher: ' . $teacherName . ' (ID: ' . $teacherId . ')',
           
        );

        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
    }

    /**
     * Show the form for editing user permissions.
     */
    public function editPermissions($userId)
    {
        $user = User::with('permissions')->findOrFail($userId);
        $permissions = Permission::all();
        $userPermissions = $user->permissions->pluck('id')->toArray();
        return view('users.permissions.edit', compact('user', 'permissions', 'userPermissions'));
    }

    /**
     * Update user permissions.
     */
    public function updatePermissions(Request $request, $userId)
    {
        $user = User::findOrFail($userId);
        $user->permissions()->sync($request->input('permissions', []));

        // Log activity
        app(ActivityLogController::class)->log(
            'Teacher Permissions Updated',
            'Updated permissions for teacher: ' . $user->name . ' (User ID: ' . $userId . ')',
            'Teacher',
            $user->teacher->id ?? null
        );

        return redirect()->route('teacher.index')
            ->with('success', 'Permissions updated successfully!');
    }
}