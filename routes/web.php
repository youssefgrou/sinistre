<?php

use App\Http\Controllers\Admin\SinistreController;
use App\Http\Controllers\Admin\ClientController;
use App\Http\Controllers\Admin\DashboardController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\ClientController as UserClientController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

// Redirect authenticated users based on their role
Route::get('/dashboard', function () {
    if (auth()->check()) {
        if (auth()->user()->isAdmin()) {
            return redirect()->route('admin.dashboard');
        } else {
            return redirect()->route('client.dashboard');
        }
    }
    return redirect()->route('login');
})->name('dashboard');

// Admin routes
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [DashboardController::class, 'index'])->name('dashboard');
    Route::resource('sinistres', SinistreController::class);
    Route::resource('clients', ClientController::class);
});

// Client routes
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/dashboard', [UserClientController::class, 'dashboard'])->name('client.dashboard');
});

// Profile routes (accessible by both roles)
Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    // Routes pour l'espace client
    Route::prefix('client')->name('client.')->group(function () {
        Route::resource('sinistres', \App\Http\Controllers\Client\SinistreController::class);
        Route::post('sinistres/{sinistre}/documents', [\App\Http\Controllers\Client\SinistreController::class, 'uploadDocuments'])
            ->name('sinistres.documents.upload');
    });
});

require __DIR__.'/auth.php';