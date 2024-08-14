<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;

// Example GET route
Route::get('/user', function () {
    return "Hello Umang";
});

// Example POST route
Route::post('/user', function (Request $request) {
    return response()->json(['message' => 'Post API is Successfully!', 'data' => $request->all()]);
});
