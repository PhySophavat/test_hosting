<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;

class TeacherController extends Controller
{
    // Show all teachers
    public function index()
    {
        $teachers = Teacher::all();
        return view('teacher.index', compact('teachers'));
    }

    // Show create form
    public function create()
    {
        return view('teacher.create');
    }

    // Store teacher
    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
        ]);

        Teacher::create($validated);

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
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
        ]);

        $teacher->update($validated);

        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully!');
    }

    // Delete teacher
    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
    }
}
