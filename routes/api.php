<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\foodController;
use App\Http\Middleware\Authenticate;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::prefix('foods')->group(function(){
    Route::get('/', [foodController::class, 'index'])-> middleware(Authenticate::class);
    Route::get('/{id}', [foodController::class, 'getFood']);
    Route::post('/', [foodController::class, 'newFood']);
    Route::put('/{id}', [foodController::class, 'updateFood']);
    Route::delete('/{id}', [foodController::class, 'destroyFood']);
});

Route::prefix('auth')->group(function(){
    Route::post('/register', [AuthController::class, 'register']);
    Route::post('/login', [AuthController::class, 'login']);
});
