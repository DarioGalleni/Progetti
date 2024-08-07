<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\SnowboardController;

//! sempre disponibili
Route::get('/',[Controller::class, 'home'])->name('home');
Route::get('/index',[Controller::class, 'index'])->name('index');
Route::get('/mostra{id}',[Controller::class, 'mostra'])->name('mostra');

//! aggiunti
Route::get('/crea',[SnowboardController::class, 'crea'])->name('crea');
Route::get('/index/added',[SnowboardController::class, 'added'])->name('indexAdded');



