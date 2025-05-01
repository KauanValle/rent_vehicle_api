<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\CustomerController;
use App\Http\Controllers\RentalController;
use App\Http\Controllers\VehicleController;
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


Route::prefix('customers')->group(function () {
    Route::apiResource('/', CustomerController::class)->parameters([
        '' => 'id'
    ])->middleware('jwt.auth');
});

Route::prefix('vehicles')->group(function () {
    Route::apiResource('/', VehicleController::class)->parameters([
        '' => 'id'
    ])->middleware('jwt.auth');
});

Route::prefix('rental')->group(function () {
    Route::post('/', [RentalController::class, 'create'])->middleware('jwt.auth');
    Route::post('/{id}/start', [RentalController::class, 'start'])->middleware('jwt.auth');
    Route::post('/{id}/end', [RentalController::class, 'end'])->middleware('jwt.auth');
    Route::get('/{id}', [RentalController::class, 'show'])->middleware('jwt.auth');
    Route::get('/', [RentalController::class, 'index'])->middleware('jwt.auth');
    Route::get('/reports/revenue', [RentalController::class, 'reportsRevenue'])->middleware('jwt.auth');
});


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::post('/logout', [AuthController::class, 'logout'])->middleware('jwt.auth');

