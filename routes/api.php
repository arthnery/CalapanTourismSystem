<?php

use App\Models\TourismSpot;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');

Route::get('/tourism-spots', function () {
    return TourismSpot::with('category')->get();
});
