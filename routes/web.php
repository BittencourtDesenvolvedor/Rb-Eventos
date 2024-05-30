<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('index');
Route::get('/create', [EventController::class, 'create'])->name('create');
Route::post('/store', [EventController::class, 'store'])->name('event.store');
Route::get('/show/{id}', [EventController::class, 'show'])->name('event.show');

