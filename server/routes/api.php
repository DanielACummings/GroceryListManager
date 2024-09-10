<?php

use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$baseRoute = 'api/';

Route::get($baseRoute, function () {
    return response()->json(['message' => 'UI is connected to API']);
});

Route::post("{$baseRoute}login", [UserController::class, 'login']);
Route::post("{$baseRoute}register", [UserController::class, 'register']);
