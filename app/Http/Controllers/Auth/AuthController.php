<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Http\Requests\SigninRequest;
use App\Http\Requests\SignupRequest;
use App\Services\AuthService;
use Illuminate\Auth\AuthenticationException;
use Illuminate\Http\Request;

class AuthController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }

    public function showLoginForm()
    {
        return view('auth.signin');
    }

    public function showSignupForm()
    {
        return view('auth.signup');
    }

    public function register(SignupRequest $request)
    {
        try {
            $token = $this->authService->register($request->all());

            return response()->json(['message' => 'User registered successfully', 'token' => $token], 201);
        } catch (\Exception $e) {
            return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
        }
    }

    public function login(SigninRequest $request)
    {
        try {
            $result = $this->authService->login($request->validated());

            return response()->json([
                'message' => 'User logged in successfully',
                'user' => $result['user'],
                'token' => $result['token']
            ], 200);
        } catch (AuthenticationException $e) {
            return response()->json([
                'message' => 'The provided credentials are incorrect.',
                'error' => $e->getMessage()
            ], 401);
        } catch (\Exception $e) {
            return response()->json([
                'message' => 'An unexpected error occurred',
                'error' => $e->getMessage()
            ], 500);
        }
    }
}
