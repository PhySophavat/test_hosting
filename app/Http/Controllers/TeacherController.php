<?php

namespace App\Http\Controllers;

use App\Models\Teacher;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class TeacherController extends Controller
{
    public function index()
    {
       $teachers = Teacher::with('user')->get();
return view('teacher.index', compact('teachers'));

    }

    public function create()
    {
        return view('teacher.create');
    }

    public function store(Request $request)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email',
            'password' => 'nullable|string|min:6',
            'subject' => 'nullable|string|max:255',
        ]);

        if(!empty($validated['password'])){
            $validated['password'] = Hash::make($validated['password']);
        }

        Teacher::create($validated);

        return redirect()->route('teacher.index')->with('success', 'Teacher added successfully!');
    }

    public function edit(Teacher $teacher)
    {
        return view('teacher.edit', compact('teacher'));
    }

    public function update(Request $request, Teacher $teacher)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'email' => 'required|email|unique:teachers,email,' . $teacher->id,
            'password' => 'nullable|string|min:6',
            'subject' => 'nullable|string|max:255',
        ]);

        if(!empty($validated['password'])){
            $validated['password'] = Hash::make($validated['password']);
        } else {
            unset($validated['password']); // keep old password if empty
        }

        $teacher->update($validated);

        return redirect()->route('teacher.index')->with('success', 'Teacher updated successfully!');
    }

    public function destroy(Teacher $teacher)
    {
        $teacher->delete();
        return redirect()->route('teacher.index')->with('success', 'Teacher deleted successfully!');
    }
}
