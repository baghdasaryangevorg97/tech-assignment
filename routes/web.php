<?php

use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::group(['prefix' => 'auth'], function () {
    Route::get('/signin', [AuthController::class, 'showLoginForm'])->name('signin');
    Route::get('/signup', [AuthController::class, 'showSignupForm'])->name('signup');
});

Route::group(['prefix' => 'websites'], function () {
    Route::get('/', [WebsiteController::class, 'index'])->name('websites');
});

Route::group(['prefix' => 'report'], function () {
    Route::get('/', [ReportController::class, 'index'])->name('report');
});



