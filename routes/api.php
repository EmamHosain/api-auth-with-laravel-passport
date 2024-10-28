<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\AuthController;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:api');



// open route
Route::controller(AuthController::class)->group(function () {
    Route::post('/login', 'login');
    Route::post('/register', 'register');
});


// protected route
Route::controller(AuthController::class)->middleware('auth:api')->group(function () {
    Route::get('/profile', 'profile');
    Route::get('/logout', 'logout');
});

Route::get('/get-token', [AuthController::class, 'getToken']);