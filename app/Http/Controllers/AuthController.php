<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class AuthController extends Controller
{
    // Login Page
    public function login()
    {
        return view('login');
    }

    // Register Page
    public function register()
    {
        return view('register');
    }

    // direct dashboard
    public function dashboard()
    {
        if(Auth::user()->role == 'admin'){
            return redirect()->route('admin#home');
        }
        return redirect()->route('user#home');
    }
}
