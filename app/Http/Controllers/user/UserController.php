<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\AuthRequest;
use App\Services\AuthService;
use Illuminate\Http\Request;

class UserController extends Controller
{

    protected $authService;

    public function __construct(AuthService $authService)
    {
        $this->authService = $authService;
    }
    public function index()
    {
        dd(1211);
    }

    // public function register(AuthRequest $request)
    // {
    //     try {
    //         $user = $this->authService->register($request->all());

    //         return response()->json(['message' => 'User registered successfully', 'user' => $user], 201);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Registration failed', 'error' => $e->getMessage()], 500);
    //     }
    // }

    // public function login(AuthRequest $request)
    // {
    //     try {
    //         $user = $this->authService->login($request->all());

    //         return response()->json(['message' => 'User logged in successfully', 'user' => $user], 200);
    //     } catch (\Exception $e) {
    //         return response()->json(['message' => 'Login failed', 'error' => $e->getMessage()], 401);
    //     }
    // }
}
