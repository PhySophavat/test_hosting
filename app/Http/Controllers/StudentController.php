<?php

namespace App\Http\Controllers;

use App\Models\Student;
use App\Models\Teacher;
use App\Models\User;
use Illuminate\Http\Request;

class StudentController extends Controller
{
    public function index()
{
    $students = Student::with('user')->get(); 
    return view('student.index', compact('students'));
}


   
    public function create()
    {
        return view('student.create');
    }

    
   
public function store(Request $request)
{
    $validated = $request->validate([
        'name' => 'required|string|max:255',
        'password' => 'nullable|string|min:6',
        'subject' => 'nullable|string|max:255',
    ]);

    $user =User::create([
        'name' => $request->name,
        'email' => $request->email,
        'password' =>$request->password,
    ]);

     Teacher::create([
        'user_id' => $user->id,
        'subject' => $validated['subject'] ?? null,
    ]);

    return redirect()->route('teacher.index')->with('success', 'Teacher added successfully!');
}
    public function edit(Student $student)
    {
        return view('student.edit', compact('student'));
    }


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

   
    public function destroy(Student $student)
    {
        $student->delete();
        return redirect()->route('student.index')->with('success', 'Student deleted successfully!');
    }
}
