<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::apiResource('/event', App\Http\Controllers\EventController::class);
Route::apiResource('/interest', App\Http\Controllers\InterestController::class);