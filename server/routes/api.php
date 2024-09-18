<?php

use App\Http\Controllers\ListController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

$baseRoute = 'api';

Route::get("{$baseRoute}/", function () {
    return response()->json(['message' => 'UI is connected to API']);
});
Route::get("{$baseRoute}/lists", [ListController::class, 'index']);
Route::post("{$baseRoute}/lists", [ListController::class, 'store']);
Route::get("{$baseRoute}/sanctum/csrf-cookie", function () {
    return response() ->json(['token' => csrf_token()]);
})
->middleware('web');

Route::post("{$baseRoute}/login", [UserController::class, 'login']);
Route::post("{$baseRoute}/register", [UserController::class, 'register']);
