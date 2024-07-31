<?php

namespace App\Services;

use App\Models\User;
use Illuminate\Support\Facades\Hash;

class AuthService
{
    public function register(array $data): string
    {
        $user = User::create([
            'name' => $data['name'],
            'email' => $data['email'],
            'password' => Hash::make($data['password']),
        ]);

        $token =  $user->createToken('auth_token')->plainTextToken;

        return $token;
    }

    public function login(array $data): object
    {
        dd($data);
        // if (Auth::attempt(['email' => $data['email'], 'password' => $data['password']])) {
        //     $user = Auth::user();
        //     return $user;
        // }

        // throw new \Exception('Invalid credentials');
    }
}
