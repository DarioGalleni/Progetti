<?php

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Route;

Route::get('/',[Controller::class, 'home'])->name('home');
Route::get('/index',[Controller::class, 'index'])->name('index');
Route::get('/show/{id}',[Controller::class, 'show'])->name('show');

