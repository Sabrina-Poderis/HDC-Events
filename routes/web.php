<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'SiteController@index');
Route::get('/contato', 'SiteController@contact')->name('contato');
Route::get('/eventos', 'SiteController@events')->name('eventos');
Route::get('/evento/{id}', 'SiteController@event')->name('evento');

Route::post('/login', 'UserAuth\LoginController@login');
Route::post('/logout', 'UserAuth\LoginController@logout');
Route::post('/register', 'UserAuth\RegisterController@register');

// Admin
Route::prefix('admin')->group(function () {
    Route::get('/', 'DashboardController@index');
    Route::post('/profile', 'DashboardController@updateProfile');

    Route::get('/estabelecimentos', 'EstablishmentController@index');
    Route::post('/estabelecimento/store', 'EstablishmentController@store');
    Route::post('/estabelecimento/update', 'EstablishmentController@update');
    Route::post('/estabelecimento/destroy', 'EstablishmentController@destroy');
    Route::get('/getEstablishments', 'EstablishmentController@getEstablishments');
    Route::get('/getEstablishment', 'EstablishmentController@getEstablishment');

    Route::get('/eventos', 'EventController@index');
    Route::post('/evento/store', 'EventController@store');
    Route::post('/evento/update', 'EventController@update');
    Route::post('/evento/destroy', 'EventController@destroy');
    Route::get('/getEvents', 'EventController@getEvents');
    Route::get('/getEvent', 'EventController@getEvent');

    Route::get('/usuarios', 'UserController@index');
    Route::post('/usuario/store', 'UserController@store');
    Route::post('/usuario/update', 'UserController@update');
    Route::post('/usuario/destroy', 'UserController@destroy');
    Route::get('/getUsers', 'UserController@getUsers');
    Route::get('/getUser', 'UserController@getUser');
});