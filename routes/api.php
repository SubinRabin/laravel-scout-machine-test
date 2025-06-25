<?php
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchLogController;

Route::get('/ping', function () {
    return response()->json(['message' => 'Ping'], 200);
});


Route::get('/search', [SearchController::class, 'search']);
Route::get('/search/suggestions', [SearchController::class, 'suggestions']);
Route::get('/search/logs', [SearchLogController::class, 'index'])->middleware('auth:sanctum');

Route::middleware('auth:sanctum')->get('/search/logs', [SearchController::class, 'logs']);
Route::middleware('auth:sanctum')->post('/search/reindex', [SearchController::class, 'reindex']);
