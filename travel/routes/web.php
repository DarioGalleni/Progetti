<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JourneyController;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "web" middleware group. Make something great!
|
*/

Route::get('/', function () {
    $journeys = \App\Models\Journey::inRandomOrder()->take(3)->get();
    return view('welcome', compact('journeys'));
})->name('home');

Route::get('journeys/{journey}/gallery', [JourneyController::class, 'gallery'])->name('journeys.gallery');
Route::resource('journeys', JourneyController::class);
