<?php

use App\Http\Controllers\PageController;
use Illuminate\Support\Facades\Route;


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

