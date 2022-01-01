<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/eventos', function () {
    return view('events');
});

Route::get('/evento', function () {
    return view('event');
});

Route::get('/contato', function () {
    return view('contact');
});