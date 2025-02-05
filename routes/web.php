<?php

use App\Http\Controllers\EconomicGroupsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileLogedController;
use Illuminate\Support\Facades\Route;

Route::middleware('auth')->group(function () {
    Route::get('/', function () {
        return view('dashboard');
    });
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';

Route::middleware('auth')->group(function () {
    Route::get('/profile_user', [ProfileLogedController::class, 'index'])->name('profile.index');
    Route::get('economic_groups', [EconomicGroupsController::class, 'index'])->name('economic_groups.index'); 
});