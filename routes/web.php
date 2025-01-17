<?php

use App\Http\Controllers\NavigationController;
use App\Http\Controllers\PageController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\RoleController;
use App\Http\Controllers\UserController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome', [
        'navigations' => \App\Models\Navigation::with('pages')->get()
    ]);
})->name('welcome');

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::resource('users', UserController::class);
    Route::resource('roles', RoleController::class);
    Route::resource('pages', PageController::class)->except('show');
    Route::resource('navigations', NavigationController::class);
});

Route::resource('pages', PageController::class)->only('show');

require __DIR__.'/auth.php';
