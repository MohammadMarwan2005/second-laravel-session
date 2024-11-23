<?php
use App\Http\Controllers\ProductController;

Route::get('/', function () {
    return view('welcome');
});

Route::post('/products', [ProductController::class, 'addProduct']);

Route::get('/products', [ProductController::class, 'getAllProducts']);