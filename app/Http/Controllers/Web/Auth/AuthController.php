<?php

namespace App\Http\Controllers\Web\Auth;

use App\Http\Controllers\Controller;

class AuthController extends Controller
{

    public function showLoginForm()
    {
        return view('auth.signin');
    }

    public function showSignupForm()
    {
        return view('auth.signup');
    }

}
