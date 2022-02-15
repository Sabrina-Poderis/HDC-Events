<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'SiteController@index');
Route::get('/contato', 'SiteController@contact');
Route::get('/eventos', 'SiteController@events');
Route::get('/evento/{id}', 'SiteController@event');

Route::post('/login', 'UserAuth\LoginController@login');
Route::post('/logout', 'UserAuth\LoginController@logout');
Route::post('/register', 'UserAuth\RegisterController@register');

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/', function () {return view('admin.index');});

    Route::get('/estabelecimentos', "EstablishmentController@index");
    Route::post('/estabelecimento/store', "EstablishmentController@store");
    Route::post('/estabelecimento/update', "EstablishmentController@update");
    Route::post('/estabelecimento/destroy', "EstablishmentController@destroy");
    Route::get('/getEstablishments', "EstablishmentController@getEstablishments");
    Route::get('/getEstablishment', "EstablishmentController@getEstablishment");

    Route::get('/eventos', "EventController@index");
    Route::post('/evento/store', "EventController@store");
    Route::post('/evento/update', "EventController@update");
    Route::post('/evento/destroy', "EventController@destroy");
    Route::get('/getEvents', "EventController@getEvents");
    Route::get('/getEvent', "EventController@getEvent");

    Route::get('/usuarios', function () {
        return view('admin.users');
    });
});