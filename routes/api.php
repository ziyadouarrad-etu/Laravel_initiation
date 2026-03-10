<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::apiResource('loans', App\Http\Controllers\LoanController::class);

// Additional route for marking a loan as returned via PATCH request
Route::patch('loans/{id}/return', [App\Http\Controllers\LoanController::class, 'markAsReturned']);