<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\ProjectController;
use App\Http\Controllers\Api\CategoryController;

// Define API resource route correctly
Route::apiResource('/project', ProjectController::class);
Route::apiResource('/categories', CategoryController::class);

// Example route with Sanctum middleware
Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');