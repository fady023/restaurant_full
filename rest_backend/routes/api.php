<?php

use App\Http\Controllers\Api\AdminController;
use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\BookingController;
use App\Http\Controllers\Api\MenuController;
use App\Http\Controllers\Api\NotificationController;
use Illuminate\Support\Facades\Route;


Route::post('/register', [AuthController::class, 'register']);
Route::post('/login',    [AuthController::class, 'login']);
Route::get('/menu',      [MenuController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout',  [AuthController::class, 'logout']);
    Route::get('/profile',  [AuthController::class, 'profile']);
    Route::put('/profile',  [AuthController::class, 'updateProfile']);

    Route::post('/bookings',        [BookingController::class, 'store']);
    Route::get('/bookings/my',      [BookingController::class, 'myBookings']);

    Route::get('/notifications',            [NotificationController::class, 'index']);
    Route::put('/notifications/{id}/read',  [NotificationController::class, 'markRead']);

});

Route::middleware(['auth:sanctum', 'admin'])->prefix('admin')->group(function () {
    Route::post('/menu',        [MenuController::class, 'store']);
    Route::put('/menu/{id}',    [MenuController::class, 'update']);
    Route::delete('/menu/{id}', [MenuController::class, 'destroy']);

    Route::get('/bookings',                     [BookingController::class, 'index']);
    Route::put('/bookings/{id}/status',         [BookingController::class, 'updateStatus']);

    Route::get('/users',[AdminController::class, 'users']);

});