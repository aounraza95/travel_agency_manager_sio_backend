<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\DestinationController;
use App\Http\Controllers\Api\V1\ActivitiesController;
use App\Http\Controllers\Api\V1\AuthController;

Route::prefix('v1')->group(function () {
    // Auth APIs
    Route::post('/login', [AuthController::class, 'login']);
    Route::post('/register', [AuthController::class, 'register']);

    Route::middleware('auth:sanctum')->group(function () {
        Route::post('/logout', [AuthController::class, 'logout']);
        Route::get('/user', function (Request $request) {
            return $request->user();
        });
    });

    // Destination APIS
    // Public routes
    Route::get('destination', [DestinationController::class, 'index']);
    Route::get('destination/search', [DestinationController::class, 'getDestinationWithRelations']);
    Route::get('destination/{travelPlan}', [DestinationController::class, 'show']);

    // Admin routes
    Route::middleware(['auth:sanctum', 'admin'])->group(function () {
        Route::post('destination', [DestinationController::class, 'store']);
        Route::put('destination/{travelPlan}', [DestinationController::class, 'update']);
        Route::delete('destination/{travelPlan}', [DestinationController::class, 'destroy']);

        // Activities Admin routes (assuming typical resource methods)
        Route::post('activities', [ActivitiesController::class, 'store']);
        Route::put('activities/{activity}', [ActivitiesController::class, 'update']);
        Route::delete('activities/{activity}', [ActivitiesController::class, 'destroy']);
    });

    // Activities Public routes
    Route::get('activities', [ActivitiesController::class, 'index']);
    Route::get('activities/{activity}', [ActivitiesController::class, 'show']);
});

