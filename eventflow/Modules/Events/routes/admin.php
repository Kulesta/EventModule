<?php

use Illuminate\Support\Facades\Route;
use Modules\Events\Http\Controllers\Admin\EventController;

// NO middleware or prefix here - it's already in RouteServiceProvider!
Route::get('/events', [EventController::class, 'index'])->name('events.index');
Route::get('/events/create', [EventController::class, 'create'])->name('events.create');
Route::post('/events', [EventController::class, 'store'])->name('events.store');
Route::get('/events/{id}/edit', [EventController::class, 'edit'])->name('events.edit');
Route::put('/events/{id}', [EventController::class, 'update'])->name('events.update');
Route::delete('/events/{id}', [EventController::class, 'destroy'])->name('events.destroy');
Route::post('/events/{id}/publish', [EventController::class, 'publish'])->name('events.publish');