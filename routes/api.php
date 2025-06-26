<?php

use App\Http\Controllers\AuthController;
use App\Http\Controllers\BlogPostController;
use App\Http\Controllers\FaqController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProductController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SearchController;
use App\Http\Controllers\SearchLogController;
use Illuminate\Http\Request;

Route::get('/ping', function () {
    return response()->json(['message' => 'Ping'], 200);
});

Route::post('/login', [AuthController::class, 'login']);


Route::get('/profile', function (Request $request) {
    if (! $request->user()) {
        return response()->json(['message' => 'Unauthenticated.'], 401);
    }

    return response()->json($request->user());
})->middleware('auth:sanctum');

Route::get('/search', [SearchController::class, 'search']);
Route::get('/search/suggestions', [SearchController::class, 'suggestions']);

Route::get('/search/logs', [SearchLogController::class, 'index'])->middleware(['auth:sanctum', 'admin']);




Route::prefix('blogpost')->group(function () {
    Route::get('/', [BlogPostController::class, 'list']);
    Route::post('/store', [BlogPostController::class, 'store']);
    Route::post('/update/{id}', [BlogPostController::class, 'update']);
    Route::get('/destroy/{id}', [BlogPostController::class, 'destroy']);
});


Route::prefix('product')->group(function () {
    Route::get('/', [ProductController::class, 'list']);
    Route::post('/store', [ProductController::class, 'store']);
    Route::post('/update/{id}', [ProductController::class, 'update']);
    Route::get('/destroy/{id}', [ProductController::class, 'destroy']);
});


Route::prefix('page')->group(function () {
    Route::get('/', [PageController::class, 'list']);
    Route::post('/store', [PageController::class, 'store']);
    Route::post('/update/{id}', [PageController::class, 'update']);
    Route::get('/destroy/{id}', [PageController::class, 'destroy']);
});

Route::prefix('faq')->group(function () {
    Route::get('/', [FaqController::class, 'list']);
    Route::post('/store', [FaqController::class, 'store']);
    Route::post('/update/{id}', [FaqController::class, 'update']);
    Route::get('/destroy/{id}', [FaqController::class, 'destroy']);
});
