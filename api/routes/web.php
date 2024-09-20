<?php

use App\Http\Controllers\ItemListController;
use Illuminate\Support\Facades\Route;

$baseRoute = 'api';

Route::get("{$baseRoute}/", function () {
    return response()->json(['message' => 'UI is connected to API']);
});
Route::get("{$baseRoute}/lists", [ItemListController::class, 'index']);
Route::get("{$baseRoute}/sanctum/csrf-cookie", function () {
    return response() ->json(['token' => csrf_token()]);
})
->middleware('web');

Route::post("{$baseRoute}/lists", [ItemListController::class, 'store']);
