<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;

// The index is the sign-in page. Everything else requires an authenticated account.
Route::view('/', 'auth.login')->middleware('guest')->name('home');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::view('/dashboard', 'dashboard')->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
