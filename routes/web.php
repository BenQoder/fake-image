<?php

use Illuminate\Support\Facades\Cache;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::fallback(function ($route) {
    $data = Cache::rememberForever($route, function () use ($route) {
        return file_get_contents('https://source.unsplash.com/random/300×300/?product');
    });

    return response($data, 200)
        ->header('Content-Type', 'image/jpeg');
});
