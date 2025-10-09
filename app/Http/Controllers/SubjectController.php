<?php

namespace App\Http\Controllers;

use App\Models\Score;
use App\Models\Student;
use App\Models\Subject;
use Illuminate\Http\Request;


class SubjectController extends Controller
{
   
    public function index(Student $student)
    {
        $subjects = Subject::all();
        $student->load('scores', 'user'); // load scores and user
        return view('subject.index', compact('student', 'subjects'));
    }

public function create(Student $student)
{
    // Load the latest subject (score)
    $student->load('latestSubject');
    return view('subject.create', compact('student'));
}

public function store(Request $request, Student $student)
{
    $validated = $request->validate([
        'math' => 'required|integer|min:0|max:100',
        'khmer' => 'required|integer|min:0|max:100',
        'english' => 'required|integer|min:0|max:100',
        'history' => 'required|integer|min:0|max:100',
        'geography' => 'required|integer|min:0|max:100',
    ]);

    // Create a new score record
    Subject::create([
        'student_id' => $student->id,
        'math' => $validated['math'],
        'khmer' => $validated['khmer'],
        'english' => $validated['english'],
        'history' => $validated['history'],
        'geography' => $validated['geography'],
    ]);

    return redirect()->route('students.index')
                     ->with('success', 'Scores created successfully!');
}

  public function show(Student $student)
{
    // Load all subjects for this student
    $subjects = Subject::where('student_id', $student->id)->get();

    return view('subject.show', compact('student', 'subjects'));
}




    }
    

