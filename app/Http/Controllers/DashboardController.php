<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Teacher;
use App\Models\Student;

class DashboardController extends Controller
{
    public function index(){
        return view('dashboard');
    }
    public function profile(){
        return view('auth.profile');
    }
    public function dashboard()
{
    $users = User::count();
    $students = Student::count();
    $teachers = Teacher::count();

    return view('dashboard', compact('users', 'students', 'teachers'));
}


  
}
