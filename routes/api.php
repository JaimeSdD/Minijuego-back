<?php

use App\Http\Controllers\GameController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;



Route::middleware('auth:sanctum')->get('/user', function (Request $request) {
    return $request->user();
});

Route::post("/player", [GameController::class, "setData"]);

Route::get("/historical", [GameController::class, "getData"]);

Route::delete("/reset", [GameController::class, "deleteData"]);