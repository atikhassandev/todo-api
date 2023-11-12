<?php

use App\Http\Controllers\TaskController;
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

Route::prefix('v1', function () {
    Route::apiResource('tasks', TaskController::class);
    Route::get('/tasks/status/{status}', [TaskController::class, 'filterByStatus']);
    Route::patch('/tasks/{id}/status', [TaskController::class, 'updateStatus']);
});
