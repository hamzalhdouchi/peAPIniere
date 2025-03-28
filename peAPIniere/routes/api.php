<?php

use App\Http\Controllers\CategoryController;
use App\Http\Controllers\CommandeController;
use App\Http\Controllers\PlantController;
use App\Http\Controllers\UserController;
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

    Route::post('/register', [UserController::class, 'register']);
    Route::post('/login', [UserController::class, 'login']);
    
    
    Route::group(['prefix' => 'test', 'middleware' => ['api:jwt']], function () {
        return response()->json([
            'message' => 'hihhohoho'
        ]);
    });


        // Route::apiResource('plante', PlantController::class);
        Route::get('plante/{slug}', [PlantController::class, 'show']);
        Route::post('plante', [PlantController::class, 'store']);
        Route::put('plante/{slug}', [PlantController::class, 'update']);
        Route::get('plante', [PlantController::class, 'index']);
        Route::delete('plante/{slug}', [PlantController::class, 'destroy']);


        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::post('/', [CategoryController::class, 'create']);
            Route::put('{id}', [CategoryController::class, 'update']);
            Route::delete('{id}', [CategoryController::class, 'delete']);
        });
   

    Route::post('/orders', [CommandeController::class, 'create']);
    Route::get('/orders', [CommandeController::class, 'index']);
    Route::put('/orders/{id}/accept', [CommandeController::class, 'accept']);
    Route::put('/orders/{id}/reject', [CommandeController::class, 'reject']);
    Route::put('/orders/{id}/status', [CommandeController::class, 'updateStatus']);
    Route::get('/orders/{id}/status', [CommandeController::class, 'getStatus']);
    Route::delete('/orders/{id}', [CommandeController::class, 'destroy']);


