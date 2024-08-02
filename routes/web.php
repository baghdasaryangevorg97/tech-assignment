<?php

use App\Http\Controllers\Web\Auth\AuthController;
use App\Http\Controllers\Web\Report\ReportController;
use App\Http\Controllers\Web\Website\WebsiteController;
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



