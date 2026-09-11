<?php

use App\Http\Controllers\Destinations\DestinationController;
use App\Http\Controllers\Reservations\ReservationController;
use Illuminate\Support\Facades\Route;

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Route paths intentionally keep the original .html-style names (and the
| ?slug= query string for destination-detail) so every existing internal
| link and script reference across the site keeps working unchanged.
|
*/

// ─── Static Pages ────────────────────────────────────────────────────────────
Route::view('/', 'home')->name('home');
Route::view('index.html', 'home');
Route::view('about.html', 'about')->name('about');
Route::view('contact.html', 'contact')->name('contact');
Route::view('course.html', 'course')->name('course');
Route::view('personalized-package.html', 'personalized-package')->name('personalized-package');
Route::view('custom-itinerary.html', 'custom-itinerary')->name('custom-itinerary');

// ─── Destinations ────────────────────────────────────────────────────────────
Route::get('travel.html', [DestinationController::class, 'index'])->name('travel');
Route::get('destination-detail.html', [DestinationController::class, 'show'])->name('destination-detail');

// ─── Reservations ────────────────────────────────────────────────────────────
Route::view('reserve.html', 'reserve')->name('reserve');
Route::post('reserve.html', [ReservationController::class, 'store'])->name('reservations.store');
