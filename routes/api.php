<?php

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Api\EventController;
use App\Http\Controllers\Api\SourceController;
use App\Http\Controllers\Api\EventTypeController;
use App\Http\Controllers\Api\FavoriteController;



Route::get('/events', [EventController::class, 'index']);
Route::get('events/{event}', [EventController::class, 'show']);

Route::get('/sources', [SourceController::class, 'index']);

Route::get('/event-types', [EventTypeController::class, 'index']);

Route::middleware('auth:sanctum')->group(function () {
    Route::get('/favorites', [FavoriteController::class, 'index']);
    Route::post('/favorites/{event}', [FavoriteController::class, 'store']);
    Route::delete('/favorites/{event}', [FavoriteController::class, 'destroy']);
});

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::middleware('auth:sanctum')->group(function () {
    Route::post('/logout', [AuthController::class, 'logout']);
    Route::get('/user', [AuthController::class, 'user']);
});
