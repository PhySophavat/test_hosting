<?php

namespace App\Http\Controllers;

use Illuminate\Auth\Events\Validated;
use Illuminate\Http\Request;


class AuthController extends Controller
{
    public function login(){
        return view('auth.login');
    }

    public function loginform($request){
        $credentials=$request->validate([
            'email'=>'required|email',
            'password'=>'required',

        ]);
        if (Auth::attempt($credentials)) {
           $request->session()->regenerate();
           return redirect()->intended('/dashboard');
       }

   if (!auth()->check()) {
           return redirect()->route('login');
       }


    }

    public function register(){
        return view('auth.register');
    }
    
}
