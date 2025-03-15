<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\InventoryController;
use App\Http\Controllers\UserController;
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

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });

// Check the server if its running or not
Route::get('health', function () {
    return response()->json(['message' => 'Server is running!'], 200);
});

// Public Route for Authentication
Route::post('login', [AuthController::class, 'login']);

// Authenticated global routes 
Route::middleware('auth:sanctum')->group(function () {
    // Route for Logout
    Route::post('logout', [AuthController::class, 'logout']);
    
    // Route for User
    Route::controller(UserController::class)->group(function () {
        // Route for getting user details
        Route::get('users', 'getUserDetails');
    });
});


// Public route for inventories
Route::get('inventories', [InventoryController::class, 'index']);

// Authenticated routes for admin
Route::middleware(['auth:sanctum', 'admin'])->group(function () {
    Route::controller(AuthController::class)->group(function () {
        // Route for registering a user
        Route::post('register', 'register');
    });

    Route::controller(UserController::class)->group(function () {
        // Route for getting all users
        Route::get('user-list', 'index');

        // Route for Soft Delete and Restore a user
        Route::delete('users/{id}', 'destroy');
        Route::post('users/{id}/restore', 'restore');
    });

    Route::controller(InventoryController::class)->group(function () {
        // Route for getting all inventories
        Route::apiResource('inventories', InventoryController::class)->except(['index']);
    });
});