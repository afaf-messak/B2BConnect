<?php

use App\Http\Controllers\AdminController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\SupplierDashboardController;
use App\Http\Controllers\SupplierOffersController;
use App\Http\Controllers\SupplierProfileController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('LandingPage');
});

Route::redirect('/dashboard', '/client/dashboard')
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', function () {
            return view('client.dashboard');
        })->name('dashboard');

        Route::prefix('demandes')->name('demandes.')->group(function () {
            Route::get('/', function () {
                return view('client.demande.index');
            })->name('index');

            Route::get('/{demande}', function (\App\Models\Demande $demande) {
                return view('client.demande.show', [
                    'demande' => $demande->load(['user', 'orders', 'offres', 'messages']),
                ]);
            })->name('show');

            Route::post('/', [\App\Http\Controllers\DemandeController::class, 'store'])->name('store');
            Route::put('/{demande}', [\App\Http\Controllers\DemandeController::class, 'update'])->name('update');
            Route::delete('/{demande}', [\App\Http\Controllers\DemandeController::class, 'destroy'])->name('destroy');
        });

        Route::get('/suppliers', function () {
            return view('client.suppliers');
        })->name('suppliers.index');

        Route::prefix('offres')->name('offers.')->group(function () {
            Route::get('/', function () {
                return view('client.offers');
            })->name('index');

            Route::get('/{offre}', function (\App\Models\Offre $offre) {
                return view('client.offers', ['selectedOffre' => $offre->load(['user', 'demande', 'messages'])]);
            })->name('show');

            Route::post('/', [\App\Http\Controllers\OffreController::class, 'store'])->name('store');
            Route::put('/{offre}', [\App\Http\Controllers\OffreController::class, 'update'])->name('update');
            Route::delete('/{offre}', [\App\Http\Controllers\OffreController::class, 'destroy'])->name('destroy');
        });
    });

    Route::prefix('supplier')->name('supplier.')->group(function () {
        Route::get('/dashboard', [SupplierDashboardController::class, 'index'])->name('dashboard');
        Route::get('/offers', [SupplierOffersController::class, 'index'])->name('offers');
        Route::get('/offers/export', [SupplierOffersController::class, 'export'])->name('offers.export');
        Route::patch('/offers/{offre}/accept', [SupplierOffersController::class, 'accept'])->name('offers.accept');
        Route::patch('/offers/{offre}/reject', [SupplierOffersController::class, 'reject'])->name('offers.reject');
        Route::get('/profile', [SupplierProfileController::class, 'show'])->name('profile');
    });

    Route::prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', function () {
            return view('admin.dashboard');
        })->name('dashboard');
        Route::get('/users', [AdminController::class, 'users'])->name('users');
        Route::get('/demandes', [AdminController::class, 'demandes'])->name('demandes');
        Route::get('/offers', [AdminController::class, 'offers'])->name('offers');
        Route::get('/moderation', [AdminController::class, 'moderation'])->name('moderation');
        Route::get('/logs', [AdminController::class, 'logs'])->name('logs');
        Route::get('/messages', [AdminController::class, 'messages'])->name('messages');
        Route::get('/settings', [AdminController::class, 'settings'])->name('settings');
    });

    Route::redirect('/demande', '/client/demandes');
    Route::get('/demande/{demande}', function (\App\Models\Demande $demande) {
        return redirect()->route('client.demandes.show', $demande);
    });

    Route::redirect('/offres', '/client/offres');
    Route::get('/offres/{offre}', function (\App\Models\Offre $offre) {
        return redirect()->route('client.offers.show', $offre);
    });

    Route::redirect('/suppliers', '/client/suppliers');

    Route::redirect('/admin', '/admin/dashboard');
});

require __DIR__ . '/auth.php';
