<?php

use App\Http\Controllers\EventController;
use Illuminate\Support\Facades\Route;

Route::get('/', [EventController::class, 'index'])->name('index');
Route::get('/create', [EventController::class, 'create'])->name('create')->middleware('auth');
Route::post('/store', [EventController::class, 'store'])->name('event.store');
Route::get('/show/{id}', [EventController::class, 'show'])->name('event.show');
Route::get('/dashboard',  [EventController::class, 'dashboard'])->name('dashboard')->middleware('auth');
Route::delete('/delete/{id}',  [EventController::class, 'destroy'])->name('event.destroy')->middleware('auth');



