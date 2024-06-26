<?php

use App\Http\Controllers\LandingController;
use App\Http\Controllers\LibraryController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', LandingController::class)->name('welcome');
Route::get('/clock', fn () => Inertia::render('Clock'))->name('clock');

Route::group(['prefix' => 'library', 'as' => 'library.'], function () {
    Route::controller(LibraryController::class)->group(function () {
        Route::get('/', 'index')->name('index');
    });
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
