<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Medications routes
Route::get('medications', 'App\Http\Controllers\MedicationController@index');
Route::get('medications/{id}', 'App\Http\Controllers\MedicationController@show');
Route::post('medications', 'App\Http\Controllers\MedicationController@store');
Route::put('medications/{id}', 'App\Http\Controllers\MedicationController@update');
Route::delete('medications/{id}', 'App\Http\Controllers\MedicationController@destroy');

//Coustomers routes
Route::get('customers', 'App\Http\Controllers\CustomerController@index');
Route::post('customers', 'App\Http\Controllers\CustomerController@store');
Route::get('customers/{id}', 'App\Http\Controllers\CustomerController@show');
Route::put('customers/{id}', 'App\Http\Controllers\CustomerController@update');
Route::delete('customers/{id}', 'App\Http\Controllers\CustomerController@destroy');



// Route::group(['prefix' => 'v1'], function () {
//     // Medication routes
    // Route::get('medications', 'App\Http\Controllers\MedicationController@index');
//     Route::get('medications/{id}', 'MedicationController@show');
//     Route::post('medications', 'MedicationController@store');
//     Route::put('medications/{id}', 'MedicationController@update');
//     Route::delete('medications/{id}', 'MedicationController@destroy');

    // Manager routes
    // Route::get('managers', 'ManagerController@index');
    // Route::get('managers/{id}', 'ManagerController@show');
    // Route::post('managers', 'ManagerController@store');
    // Route::put('managers/{id}', 'ManagerController@update');
    // Route::delete('managers/{id}', 'ManagerController@destroy');

    // Cashier routes
    // Route::get('cashiers', 'CashierController@index');
    // Route::get('cashiers/{id}', 'CashierController@show');
    // Route::post('cashiers', 'CashierController@store');
    // Route::put('cashiers/{id}', 'CashierController@update');
    // Route::delete('cashiers/{id}', 'CashierController@destroy');

    // Owner routes
    // Route::get('owners', 'OwnerController@index');
    // Route::get('owners/{id}', 'OwnerController@show');
    // Route::post('owners', 'OwnerController@store');
    // Route::put('owners/{id}', 'OwnerController@update');
    // Route::delete('owners/{id}', 'OwnerController@destroy');

    // Other routes can go here...
// });
