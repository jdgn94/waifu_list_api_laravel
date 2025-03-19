<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SessionController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/login', ["as" => "login", "uses" => [SessionController::class, "login"]]);
