<?php

use Illuminate\Support\Facades\Auth;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::get('/', function () {
    if (Auth::check()) {
        return redirect()->route('book.index');
    }

    return redirect()->route('register');
});

Route::get('/home', function () {
    return redirect()->route('book.index');
})->middleware(['auth', 'verified'])->name('home');

Route::resource('/book', BookController::class)->middleware(['auth', 'verified']);
Route::get('/report', [BookController::class, 'report'])->name('report')->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__ . '/auth.php';
