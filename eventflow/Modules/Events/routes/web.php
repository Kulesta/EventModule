<?php

use Illuminate\Support\Facades\Route;

Route::get('/', 'EventController@index')->name('home');
Route::get('/events/{id}', 'EventController@show')->name('events.show');