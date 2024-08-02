<?php

use App\Http\Controllers\Api\Website\WebsiteController;
use App\Http\Controllers\Auth\AuthController;
use App\Http\Controllers\User\UserController;
use App\Http\Controllers\Api\Report\ReportController;
use Illuminate\Support\Facades\Route;


Route::get('/check-auth', [AuthController::class, 'checkAuth']);



Route::group(['prefix' => 'v1'], function () {
    Route::group(['prefix' => 'auth'], function () {
        Route::post('/register', [AuthController::class, 'register']);
        Route::post('/login', [AuthController::class, 'login']);
    });

    Route::group(['middleware' => 'auth:sanctum'], function () {
        Route::group(['prefix' => 'websites'], function () {
            Route::get('/', [WebsiteController::class, 'index']);
            Route::get('/{id}/report', [WebsiteController::class, 'showReport']);
            Route::post('/add', [WebsiteController::class, 'store']);
            Route::put('/edit/{id}', [WebsiteController::class, 'edit']);
            Route::delete('/destroy/{id}', [WebsiteController::class, 'destroy']);
            
            // Route::get('/{id}/report', [WebsiteController::class, 'showReport']);

            // Route::middleware('auth:api')->get('/websites/{id}/report', [WebsiteReportController::class, 'show']);
        });

        Route::group(['prefix' => 'report'], function () {
            Route::get('/', [ReportController::class, 'index']);
        });

    });





});









// /api/v1/auth/register
// /api/v1/auth/login
// /api/v1/report
// /api/v1/websites
// /api/v1/websites/[id]
