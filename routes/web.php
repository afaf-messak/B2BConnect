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

    // Demande routes
    Route::get('/demande', function () {
        return view('demande.DemandePage');
    })->name('demande.index');

    Route::get('/demande/{demande}', function (\App\Models\Demande $demande) {
        return view('demande.DemandeDetailPage', ['demande' => $demande->load(['user', 'orders', 'offres', 'messages'])]);
    })->name('demande.show');

    Route::post('/demande', [\App\Http\Controllers\DemandeController::class, 'store'])->name('demande.store');
    Route::put('/demande/{demande}', [\App\Http\Controllers\DemandeController::class, 'update'])->name('demande.update');
    Route::delete('/demande/{demande}', [\App\Http\Controllers\DemandeController::class, 'destroy'])->name('demande.destroy');

    // Offres routes
    Route::get('/offres', function () {
        return view('user.Offers');
    })->name('offres.index');

    Route::get('/offres/{offre}', function (\App\Models\Offre $offre) {
        return view('offres.OffreDetailPage', ['offre' => $offre->load(['user', 'demande', 'messages'])]);
    })->name('offres.show');

    Route::post('/offres', [\App\Http\Controllers\OffreController::class, 'store'])->name('offres.store');
    Route::put('/offres/{offre}', [\App\Http\Controllers\OffreController::class, 'update'])->name('offres.update');
    Route::delete('/offres/{offre}', [\App\Http\Controllers\OffreController::class, 'destroy'])->name('offres.destroy');

    // Admin Dashboard
    Route::get('/admin', function () {
        return view('Admin.AdminDashbord');
    })->name('admin.dashboard');
});

require __DIR__ . '/auth.php';
