<?php

use App\Http\Controllers\UserController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\MedicationController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

Route::prefix('user')->name('user.')->group(function () {
    Route::post('login', [UserController::class, 'login']);
    Route::post('register', [UserController::class, 'register']);
    Route::post('check', [UserController::class, 'check']);


    Route::middleware('auth:sanctum')->group(function () {
        Route::prefix('customers')->group(function () {
            Route::get('/', [CustomerController::class, 'index']);
            Route::post('/', [CustomerController::class, 'store']);
            Route::get('/{id}', [CustomerController::class, 'show']);
            Route::put('/{id}', [CustomerController::class, 'update']);
            Route::delete('/{id}', [CustomerController::class, 'destroy']);
            Route::delete('/{id}/softdelete', [CustomerController::class, 'softDelete']);
        });
        Route::prefix('medications')->group(function () {
            Route::get('/', [MedicationController::class, 'index']);
            Route::post('/', [MedicationController::class, 'store']);
            Route::get('/{id}', [MedicationController::class, 'show']);
            Route::put('/{id}', [MedicationController::class, 'update']);
            Route::delete('/{id}', [MedicationController::class, 'destroy']);
            Route::delete('/{id}/softdelete', [MedicationController::class, 'softDelete']);
        });
    });
});





