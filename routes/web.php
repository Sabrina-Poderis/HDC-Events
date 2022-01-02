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

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/', function () {
        return view('admin.index');
    });
    Route::get('/estabelecimentos', function () {
        return view('admin.establishment');
    });
    Route::get('/eventos', function () {
        return view('admin.events');
    });
    Route::get('/usuarios', function () {
        return view('admin.users');
    });
});