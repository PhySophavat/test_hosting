<?php

namespace App\Http\Controllers;

use App\Models\Student;
use Illuminate\Http\Request;

class ScoreController extends Controller
{
    public function index(Student $student)
    {
        // Just show the view for adding score
        return view('score.index', compact('student'));
    }
}
