<?php

use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('index');
});

Route::get('/contato', function () {
    return view('contact');
});

Route::get('/produtos', function () {
    return view('products');
});