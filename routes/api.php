<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Website\WebsiteController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});


Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::get('/register', [UserController::class, 'register']);
    });

    Route::group(['prefix' => 'websites'], function () {
        Route::resource('/', WebsiteController::class);
    });
    
    
    
    
});









// /api/v1/auth/register
// /api/v1/auth/login
// /api/v1/report
// /api/v1/websites
// /api/v1/websites/[id]
