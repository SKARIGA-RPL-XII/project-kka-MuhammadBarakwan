<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/chat', function () {
    return view('halamanchat');
});

Route::get('/dashboard', function () {
    return view('dashboard');
});



