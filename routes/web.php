<?php

use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;
use App\Http\Controllers\RoomContorller;
use App\Http\Controllers\MessageContorller;
Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function () {
    return Inertia::render('Dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
    Route::get('/rooms/{room:slug}', [RoomContorller::class, 'show'])->name('rooms.show');
    Route::get('/rooms/{room:slug}/messages', [MessageContorller::class, 'index'])->name('messages.index');
    Route::post('/rooms/{room:slug}/messages', [MessageContorller::class, 'store'])->name('messages.store');
});

require __DIR__.'/auth.php';
