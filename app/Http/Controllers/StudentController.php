<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    // Display all students
    public function index()
    {
        $students = Student::all();
        return view('student.index', compact('students'));
    }

    // Show form to create a new student
    public function create()
    {
        return view('student.create');
    }

    // Store new student
    public function store(Request $request)
    {
        $validated = $request->validate([
            'id_student' => 'required|string|max:20',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:students,email',
            'phone'      => 'nullable|string|max:20',
        ]);

        Student::create($validated);

        return redirect()->route('students.index')->with('success', 'Student added successfully!');
    }

    // Show form to edit a student
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }

    // Update a student
    public function update(Request $request, Student $student)
    {
        $validated = $request->validate([
            'id_student' => 'required|string|max:20',
            'name'       => 'required|string|max:255',
            'email'      => 'required|email|unique:students,email,' . $student->id,
            'phone'      => 'nullable|string|max:20',
        ]);

        $student->update($validated);

        return redirect()->route('student.index')->with('success', 'Student updated successfully!');
    }

    // Delete a student
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
    }
}
