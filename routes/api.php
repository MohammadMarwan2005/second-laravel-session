<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;


Route::get('/user', function (Request $request) {
    return $request->user();
})->middleware('auth:sanctum');


Route::post('/products', [ProductController::class, 'addProduct']);
Route::post('/products/update', [ProductController::class, 'updateProduct']);

Route::get('/products', [ProductController::class, 'getAllProducts']);