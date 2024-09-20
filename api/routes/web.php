<?php

use App\Http\Controllers\ItemListController;
use Illuminate\Support\Facades\Route;

$baseRoute = 'api';

Route::get("{$baseRoute}/", function () {
    return response()->json(['message' => 'UI is connected to API']);
});
Route::get("{$baseRoute}/lists", [ItemListController::class, 'index']);
Route::post("{$baseRoute}/lists", [ItemListController::class, 'store']);
