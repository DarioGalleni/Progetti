<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\JourneyController;
use Illuminate\Support\Facades\Artisan;

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
Route::view('/technical-info', 'technical_info')->name('technical.info');
Route::get('/admin/journeys', [JourneyController::class, 'listTable'])->name('journeys.table');
Route::resource('journeys', JourneyController::class);

Route::get('/pulisci', function () {
    Artisan::call('route:clear');
    Artisan::call('config:clear');
    Artisan::call('cache:clear');
    Artisan::call('view:clear');
    Artisan::call('optimize:clear');
    return 'Cache di sistema pulita! (route, config, view, optimize)';
});
