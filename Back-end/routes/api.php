<?php

use App\Http\Controllers\Api\AuthenticationController;
use App\Http\Controllers\Api\TaskController;
use App\Http\Controllers\Api\UserController;
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

Route::prefix('v1')->group(function () {
    // Public routes
    Route::post('/register', [AuthenticationController::class, 'register'])->name('register');
    Route::get('/login', [AuthenticationController::class, 'login'])->name('login');

    // Protected routes
    Route::middleware(['use_access_token_from_cookie', 'auth:sanctum'])->group(function () {
        Route::post('/logout', [AuthenticationController::class, 'logout'])->name('logout');
        Route::get('/me', [AuthenticationController::class, 'me'])->name('me');

        // User routes
        Route::get('/users', action: [UserController::class, 'index']);

        // Task routes
        Route::group(['prefix' => 'tasks'], function () {
            Route::get('/', action: [TaskController::class, 'index']);
            Route::get('/{task}', [TaskController::class, 'show']);
            Route::post('/', action: [TaskController::class, 'create']);
            Route::put('/{task}', action: [TaskController::class, 'update']);
            Route::delete('/{task}', action: [TaskController::class, 'destroy']);
        });
    });
});