<?php

use App\Http\Controllers\Auth\AuthController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});



Route::group(['prefix' => 'auth'], function () {
    Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('signin');
    Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
});
