<?php

use App\Http\Controllers\CarController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\ProfileController;
use Illuminate\Foundation\Application;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use Inertia\Inertia;

Route::get('/', function () {
    return Inertia::render('Welcome', [
        'canLogin' => Route::has('login'),
        'canRegister' => Route::has('register'),
        'laravelVersion' => Application::VERSION,
        'phpVersion' => PHP_VERSION,
    ]);
});

Route::get('/dashboard', function (Request $request) {
    if ($request->user()->role == 'admin') {
        return Inertia::render('AdminDashboard');
    }
    else{
        return Inertia::render('Dashboard');
    }
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::get('/car', [CarController::class, 'view'])->name('car.view');
    Route::post('/car', [CarController::class, 'store'])->name('car.store');
    Route::get('/car/add', [CarController::class, 'add'])->name('car.add');
    Route::post('/car/edit', [CarController::class, 'edit'])->name('car.edit');
    Route::delete('/car', [CarController::class, 'delete'])->name('car.delete');

    Route::get('/rent', [CarController::class, 'view'])->name('rent.view');
    Route::post('/rent', [CarController::class, 'store'])->name('rent.store');
    Route::get('/rent/add', [CarController::class, 'add'])->name('rent.add');
    Route::post('/rent/edit', [CarController::class, 'edit'])->name('rent.edit');
    Route::delete('/rent', [CarController::class, 'delete'])->name('rent.delete');

    Route::get('/return', [ReturnController::class, 'view'])->name('return.view');
    Route::post('/return', [ReturnController::class, 'store'])->name('return.store');
    Route::get('/return/add', [ReturnController::class, 'add'])->name('return.add');
    Route::post('/return/edit', [ReturnController::class, 'edit'])->name('return.edit');
    Route::delete('/return', [ReturnController::class, 'delete'])->name('return.delete');
});

require __DIR__.'/auth.php';
