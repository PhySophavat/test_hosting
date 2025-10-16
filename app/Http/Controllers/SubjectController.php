<?php

namespace App\Http\Controllers;

use App\Models\Subject;
use App\Models\Student;
use Illuminate\Http\Request;

class SubjectController extends Controller
{
    // Show all subjects for a student
    public function index(Student $student)
    {
        $subjects = Subject::where('student_id', $student->id)->get();
        $student->load('user');
        return view('subject.index', compact('student', 'subjects'));
    }

    // Show form to create new subjects for a student
    public function create(Student $student)
    {
        $student->load('latestSubject');
        return view('subject.create', compact('student'));
    }

    // Store subjects for a student
    public function store(Request $request, Student $student)
    {
        $validated = $request->validate([
            'math'       => 'required|integer|min:0|max:100',  // គណិតវិទ្យា
            'khmer'      => 'required|integer|min:0|max:100',  // ភាសាខ្មែរ
            'english'    => 'required|integer|min:0|max:100',  // ភាសាអង់គ្លេស
            'history'    => 'required|integer|min:0|max:100',  // ប្រវត្តិវិទ្យា
            'geography'  => 'required|integer|min:0|max:100',  // ភូមិវិទ្យា
            'chemistry'  => 'nullable|integer|min:0|max:100',  // គីមីវិទ្យា
            'physics'    => 'nullable|integer|min:0|max:100',  // រូបវិទ្យា
            'biology'    => 'nullable|integer|min:0|max:100',  // ជីវវិទ្យា
            'ethics'     => 'nullable|integer|min:0|max:100',  // សីលធម៌
            'sports'     => 'nullable|integer|min:0|max:100',  // កីឡា
        ]);

        Subject::create(array_merge($validated, [
            'student_id' => $student->id,
        ]));

        return redirect()->route('students.index')
                         ->with('success', 'ពិន្ទុបានរក្សាទុកដោយជោគជ័យ!');
    }

    // Show subjects of a student
    public function show(Student $student)
    {
        $subjects = Subject::where('student_id', $student->id)->get();
        return view('subject.show', compact('student', 'subjects'));
    }
}
