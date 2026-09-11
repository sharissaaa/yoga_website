<?php

use App\Http\Controllers\AboutController;
use App\Http\Controllers\Destinations\DestinationController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PersonalizedPackageController;
use App\Http\Controllers\Reservations\ReservationController;
use App\Http\Controllers\Reservations\ReserveController;
use App\Http\Controllers\StrapiWebhookController;
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
Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('index.html', [HomeController::class, 'index']);
Route::get('about.html', [AboutController::class, 'index'])->name('about');
Route::view('contact.html', 'contact')->name('contact');
Route::view('course.html', 'course')->name('course');
Route::get('personalized-package.html', [PersonalizedPackageController::class, 'index'])->name('personalized-package');
Route::view('custom-itinerary.html', 'custom-itinerary')->name('custom-itinerary');

// ─── Destinations ────────────────────────────────────────────────────────────
Route::get('travel.html', [DestinationController::class, 'index'])->name('travel');
Route::get('destination-detail.html', [DestinationController::class, 'show'])->name('destination-detail');

// ─── Reservations ────────────────────────────────────────────────────────────
Route::get('reserve.html', [ReserveController::class, 'index'])->name('reserve');
Route::post('reserve.html', [ReservationController::class, 'store'])->name('reservations.store');

// ─── Strapi webhook ──────────────────────────────────────────────────────────
// Called by Strapi on entry.publish/update/unpublish/delete so cached page
// content is cleared immediately instead of waiting for the cache to expire.
// See StrapiWebhookController for details.
Route::post('/webhooks/strapi', StrapiWebhookController::class)->name('webhooks.strapi');
