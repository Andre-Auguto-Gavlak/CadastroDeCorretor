<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Api\V1\CorretorController;

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

Route::prefix('v1')->group(function (){


    Route::get('/corretores', [CorretorController::class,'index']);
    Route::get('/corretores/{corretor}', [CorretorController::class,'show']);
    Route::post('/corretores', [CorretorController::class,'store']);
    Route::put('/corretores/{corretor}', [CorretorController::class,'update']);
    Route::delete('/corretores/{corretor}', [CorretorController::class,'destroy']);
});

// Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
//     return $request->user();
// });
