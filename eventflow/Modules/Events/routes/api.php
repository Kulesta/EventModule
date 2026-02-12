<?php

use Illuminate\Support\Facades\Route;

Route::get('/events', 'EventApiController@index');
Route::get('/events/upcoming', 'EventApiController@upcoming');
Route::get('/events/{id}', 'EventApiController@show');