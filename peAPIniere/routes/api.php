<?php

use App\Http\Controllers\CategoryController;
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


        Route::apiResource('plante', PlantController::class);
        Route::get('plante/{slug}', [PlantController::class, 'show'])->name('plante.show');
        Route::post('plante', [PlantController::class, 'store'])->name('plante.store');
        Route::put('plante/{slug}', [PlantController::class, 'update'])->name('plante.update');
        Route::delete('plante', [PlantController::class, 'index'])->name('plante.destroy');
        Route::delete('plante/{slug}', [PlantController::class, 'destroy'])->name('plante.destroy');


        Route::prefix('categories')->group(function () {
            Route::get('/', [CategoryController::class, 'index']);
            Route::post('/', [CategoryController::class, 'create']);
            Route::put('{id}', [CategoryController::class, 'update']);
            Route::delete('{id}', [CategoryController::class, 'delete']);
        });
   

