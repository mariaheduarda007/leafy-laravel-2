<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BookController;

Route::redirect('/', '/register');

Route::get('/', function () {
    return redirect()->route('book.index');
})->name('home')->middleware(['auth', 'verified']);

Route::resource('/book', BookController::class)->middleware(['auth', 'verified']);
Route::get('/report/book', [BookController::class, 'report'])->name('report.book')->middleware(['auth', 'verified']);


Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
