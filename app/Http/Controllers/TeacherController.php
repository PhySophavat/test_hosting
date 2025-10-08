<?php

namespace App\Http\Controllers;

use App\Models\User;
use App\Models\Teacher;
use App\Models\Role;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

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
            'password' => 'required|string|min:3',
            'subject' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => Hash::make($validated['password']),
        ]);

        Teacher::create([
            'user_id' => $user->id,
            'subject' => $validated['subject'],
        ]);

        $teacherRole = Role::where('name', 'teacher')->first();
        if ($teacherRole && !$user->roles()->where('role_id', $teacherRole->id)->exists()) {
            $user->roles()->attach($teacherRole);
        }

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
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];
        if (!empty($validated['password'])) {
            $userData['password'] = Hash::make($validated['password']);
        }
        $teacher->user->update($userData);

        $teacher->update(['subject' => $validated['subject']]);

        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully!');
    }

    /**
     * Remove the specified teacher.
     */
    public function destroy(Teacher $teacher)
    {
        $teacher->user->delete();
        $teacher->delete();
        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
    }
}