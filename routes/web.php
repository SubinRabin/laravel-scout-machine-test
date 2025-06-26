<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return response()->json(['message' => 'Welcome'], 200);
});

Route::get('/ping', function () {
    return response()->json(['message' => 'Ping'], 200);
});
