<?php

use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Website\WebsiteController;
use App\Http\Controllers\Report\ReportController;
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
    

    Route::middleware('auth:api')->get('/report', [ReportController::class, 'show']);
    
    
    
});









// /api/v1/auth/register
// /api/v1/auth/login
// /api/v1/report
// /api/v1/websites
// /api/v1/websites/[id]
