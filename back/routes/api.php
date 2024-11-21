<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;

// Define API resource route correctly
Route::apiResource('/project', ProjectController::class);

// Example route with Sanctum middleware
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');