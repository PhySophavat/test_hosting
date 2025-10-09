<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\AuthController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\StudentController;
use App\Http\Controllers\TeacherController;
use App\Http\Controllers\SubjectController;
use App\Models\Role;
Route::get('/profile',[DashboardController::class, 'profile'])->name('auth.profile');
Route::get('/', [AuthController::class, 'showLoginForm'])->name('login'); 
Route::post('/login', [AuthController::class, 'login']);                       
Route::post('/logout', [AuthController::class, 'logout'])->name('logout');      

Route::get('/dashboard',[DashboardController::class, 'index'])->name('dashboard');
////teacher

Route::get('/teacher', [TeacherController::class, 'index'])->name('teacher.index');
Route::get('/teacher/create', [TeacherController::class, 'create'])->name('teacher.create');
Route::post('/teacher', [TeacherController::class, 'store'])->name('teacher.store'); 
Route::get('/teacher/{teacher}/edit', [TeacherController::class, 'edit'])->name('teacher.edit');
Route::put('/teacher/{teacher}', [TeacherController::class, 'update'])->name('teacher.update');
Route::delete('/teacher/{teacher}', [TeacherController::class, 'destroy'])->name('teacher.destroy');

////student
Route::get('/students', [StudentController::class, 'index'])->name('students.index');
Route::get('/students/create', [StudentController::class, 'create'])->name('students.create');
Route::post('/students', [StudentController::class, 'store'])->name('students.store');
Route::get('/students/{student}/edit', [StudentController::class, 'edit'])->name('students.edit');
Route::put('/students/{student}', [StudentController::class, 'update'])->name('students.update');
Route::delete('/students/{student}', [StudentController::class, 'destroy'])->name('students.destroy');

// use App\Http\Controllers\ScoreController;
// Route::get('/subject', [SubjectController::class, 'index'])
//     ->name('subject.index')
//     ->middleware('auth');  
    // use App\Http\Controllers\SubjectController;

 Route::get('students/{student}/subjects/create', [SubjectController::class, 'create'])->name('subject.create');
Route::post('students/{student}/subjects', [SubjectController::class, 'store'])->name('subject.store');
Route::get('students/{student}/subjects', [SubjectController::class, 'show'])->name('subject.show');
Route::post('/students/{student}/subjects', [SubjectController::class, 'store'])->name('subject.store');


Route::resource('roles', RoleController::class);
Route::resource('subjects', SubjectController::class);


Route::resource('/subject', SubjectController::class);
Route::resource('/role', RoleController::class);
// Route::resource('/teacher',TeacherController::class);
Route::resource('/student', StudentController::class);
