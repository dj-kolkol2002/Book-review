<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;
use App\Http\Controllers\ReviewController;
use Illuminate\Support\Facades\RateLimiter;
use Illuminate\Cache\RateLimiting\Limit;
use Illuminate\Http\Request;


Route::get('/', function () {
    return redirect()->route('books.index');
});

Route::resource('books', BookController::class);

Route::get('/books/{book}/reviews/create', [ReviewController::class, 'create'])->name('reviews.create');
Route::post('/books/{book}/reviews', [ReviewController::class, 'store'])
    ->middleware('throttle:reviews') // ← dodaj to
    ->name('reviews.store');

