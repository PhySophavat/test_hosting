<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\A7Controller;

// Example route in class.php
  Route::get('/class/7A', [A7Controller::class, 'index'])->name('class.7A.index');
