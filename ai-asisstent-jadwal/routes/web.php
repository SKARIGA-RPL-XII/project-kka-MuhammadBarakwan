<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ChatBotController;


Route::get('/chat', function () {
    return view('halamanchat');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});

Route::get('/login', function () {
    return view('login');
})->name('login');

Route::get('/callback', function () {
    return view('callback');
})->name('callback');

Route::get('/tes-n8n', [ChatBotController::class, 'kirimPesan']);
Route::get('/chating', function () {
    return view('halamanchat');
});

