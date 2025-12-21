<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\CustomerApiController;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
*/

Route::middleware('auth:sanctum')->group(function () {
    
    // Customer API routes
    Route::apiResource('customers', CustomerApiController::class);
    
    // Current authenticated user
    Route::get('/user', function (Request $request) {
        return $request->user();
    });
});
