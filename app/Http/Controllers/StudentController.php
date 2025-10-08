<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\User; // Add this import
use App\Models\Role; // Add for role assignment
use Illuminate\Http\Request;

class StudentController extends Controller
{
    /**
     * Display a listing of students.
     */
    public function index()
    {
        $students = Student::with('user')->get();
        return view('student.index', compact('students'));
    }

    /**
     * Show the form for creating a new student.
     */
    public function create()
    {
        return view('student.create');
    }

    /**
     * Store a newly created student.
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email',
            'password' => 'required|string|min:3',
            'grade' => 'required|string|max:255',
        ]);

        $user = User::create([
            'name' => $validated['name'],
            'email' => $validated['email'],
            'password' => \Illuminate\Support\Facades\Hash::make($validated['password']),
        ]);

        Student::create([
            'user_id' => $user->id,
            'grade' => $validated['grade'],
            'name'=>$validated['name'],
            'email'=>$validated['email'],
            'password'=>$validated['password'],
        ]);

        $studentRole = Role::where('name', 'student')->first();
        if ($studentRole && !$user->roles()->where('role_id', $studentRole->id)->exists()) {
            $user->roles()->attach($studentRole);
        }

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    /**
     * Show the form for editing a student.
     */
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    /**
     * Update the specified student.
     */
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:users,email,' . $student->user->id,
            'password' => 'nullable|string|min:6',
            'grade' => 'required|string|max:255',
        ]);

        $userData = [
            'name' => $validated['name'],
            'email' => $validated['email'],
        ];
        if (!empty($validated['password'])) {
            $userData['password'] = \Illuminate\Support\Facades\Hash::make($validated['password']);
        }
        $student->user->update($userData);

        $student->update(['grade' => $validated['grade']]);

        return redirect()->route('students.index')->with('success', 'Student updated successfully!');
    }

    /**
     * Remove the specified student.
     */
    public function destroy(Student $student)
    {
        $student->user->delete();
        $student->delete();
        return redirect()->route('students.index')->with('success', 'Student deleted successfully!');
    }
}