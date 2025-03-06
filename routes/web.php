<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ContController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    
    Route::resource('contacts', ContController::class)
        ->only(['index', 'store', 'edit', 'update', 'destroy']);
});
Route::get('/contacts', [ContController::class, 'index'])->name('contacts.index');
Route::post('/contacts', [ContController::class, 'store'])->name('contacts.store');

require __DIR__.'/auth.php';
