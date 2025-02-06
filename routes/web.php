<?php

use App\Http\Controllers\EconomicGroupsController;
use App\Http\Controllers\EmployeesController;
use App\Http\Controllers\FlagsController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\ProfileLogedController;
use App\Http\Controllers\UnitsController;
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
    Route::get('flags', [FlagsController::class, 'index'])->name('flags.index'); 
    Route::get('units', [UnitsController::class, 'index'])->name('units.index'); 
    Route::get('employees', [EmployeesController::class, 'index'])->name('employees.index'); 
});