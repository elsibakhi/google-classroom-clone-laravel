<?php

use App\Http\Controllers\Api\v1\AccessTokensController;
use App\Http\Controllers\Api\v1\ClassroomController;

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

Route::middleware('auth:sanctum')->group(function () {

    Route::get('/user', function (Request $request) {
        return $request->user();
    });



    Route::apiResource("classrooms", ClassroomController::class);
    Route::get("/auth/tokens", [AccessTokensController::class,"index"]);
    Route::delete("/auth/tokens/{id?}", [AccessTokensController::class,"destroy"]);

});

Route::middleware('guest:sanctum')->group(function () {




    Route::post("/auth/tokens", [AccessTokensController::class,"store"]);



});

