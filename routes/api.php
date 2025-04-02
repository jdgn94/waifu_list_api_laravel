<?php

use App\Http\Controllers\V1\ChatController;
use App\Http\Controllers\V1\ProfileController;
use Illuminate\Support\Facades\Route;

Route::group(['prefix' => 'v1'/* , 'middleware' => 'auth:sanctum' */], function () {
    Route::group(['prefix' => 'chats'], function () {
        Route::get('/', [ChatController::class, 'index']);
        Route::get('/{telegram_id}', [ChatController::class, 'show']);
        Route::post('/', [ChatController::class, 'store']);
        Route::put('/{telegram_id}', [ChatController::class, 'update']);
        Route::delete('/{telegram_id}', [ChatController::class, 'destroy']);
    });
    Route::group(['prefix' => 'profiles'], function () {
        Route::get('/', [ProfileController::class, 'index']);
        Route::get('/{telegram_id}', [ProfileController::class, 'show']);
        Route::post('/', [ProfileController::class, 'store']);
        Route::put('/{telegram_id}', [ProfileController::class, 'update']);
        Route::delete('/{telegram_id}', [ProfileController::class, 'destroy']);
    });
});