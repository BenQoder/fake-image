<?php

use Illuminate\Support\Str;
use Illuminate\Support\Facades\Mail;
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

Route::get('/test', function () {
    dispatch(function () {
        sleep(15);

        Mail::raw('plain text message', function ($message) {
            $message->from('john@johndoe.com', 'John Doe');
            $message->sender('john@johndoe.com', 'John Doe');
            $message->to('john@johndoe.com', 'John Doe');
            $message->cc('john@johndoe.com', 'John Doe');
            $message->bcc('john@johndoe.com', 'John Doe');
            $message->replyTo('john@johndoe.com', 'John Doe');
            $message->subject('Subject');
            $message->priority(3);
        });
    })->afterResponse();
    return "Yes";
});





Route::fallback(function ($route) {
    $data = Cache::rememberForever(Str::beforeLast($route, '/'), function () use ($route) {
        return file_get_contents('https://source.unsplash.com/random/300×300/?product');
    });

    return response($data, 200)
        ->header('Content-Type', 'image/jpeg');
});
