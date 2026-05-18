<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierDashboardController;
use App\Http\Controllers\SupplierOffersController;
use App\Http\Controllers\SupplierProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('LandingPage');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/supplier/dashboard', [SupplierDashboardController::class, 'index'])->name('supplier.dashboard');
    Route::get('/supplier/offers', [SupplierOffersController::class, 'index'])->name('supplier.offers');
    Route::get('/supplier/offers/export', [SupplierOffersController::class, 'export'])->name('supplier.offers.export');
    Route::patch('/supplier/offers/{offre}/accept', [SupplierOffersController::class, 'accept'])->name('supplier.offers.accept');
    Route::patch('/supplier/offers/{offre}/reject', [SupplierOffersController::class, 'reject'])->name('supplier.offers.reject');
    Route::get('/supplier/profile', [SupplierProfileController::class, 'show'])->name('supplier.profile');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

require __DIR__.'/auth.php';
