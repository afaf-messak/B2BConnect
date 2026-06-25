<?php

use App\Http\Controllers\AdminDemandeController;
use App\Http\Controllers\AdminMessageController;
use App\Http\Controllers\AdminOfferController;
use App\Http\Controllers\AdminSettingsController;
use App\Http\Controllers\AdminUserController;
use App\Http\Controllers\AdminModerationController;
use App\Http\Controllers\AdminDashboardController;
use App\Http\Controllers\AdminOrderController;
use App\Http\Controllers\AdminProductController;
use App\Http\Controllers\AdminStatisticsController;
use App\Http\Controllers\ClientDashboardController;
use App\Http\Controllers\ClientDemandeViewController;
use App\Http\Controllers\ClientFavoriteController;
use App\Http\Controllers\ClientOfferController;
use App\Http\Controllers\ClientOrderController;
use App\Http\Controllers\ConversationController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\LocaleController;
use App\Http\Controllers\PortalSettingsController;
use App\Http\Controllers\ProductCatalogController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\PublicMarketplaceController;
use App\Http\Controllers\SupplierDashboardController;
use App\Http\Controllers\SupplierDemandeController;
use App\Http\Controllers\SupplierOffersController;
use App\Http\Controllers\SupplierOrderController;
use App\Http\Controllers\SupplierProductController;
use App\Http\Controllers\SupplierProfileController;
use App\Http\Controllers\SupplierQuotationController;
use App\Models\User;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('landing.index', [
        'landingStats' => \App\Support\LandingStats::items(),
        'heroDashboard' => \App\Support\LandingStats::heroDashboard(),
    ]);
});

Route::get('/products', [ProductCatalogController::class, 'index'])->name('products.catalog');
Route::get('/products/{product}', [ProductCatalogController::class, 'show'])->name('products.show');

Route::prefix('marketplace')->name('marketplace.')->group(function () {
    Route::get('/suppliers', [PublicMarketplaceController::class, 'suppliers'])->name('suppliers.index');
    Route::get('/suppliers/{profile:slug}', [PublicMarketplaceController::class, 'supplierShow'])->name('suppliers.show');
});

Route::match(['get', 'post'], '/locale/{locale}', [LocaleController::class, 'switch'])->name('locale.switch');

Route::middleware(['auth', 'verified'])->group(function () {
    Route::get('/dashboard', DashboardController::class)->name('dashboard');

    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::middleware('role:'.User::ROLE_CLIENT.','.User::ROLE_SUPPLIER)->prefix('messages')->name('messages.')->group(function () {
        Route::get('/', [ConversationController::class, 'index'])->name('index');
        Route::get('/with/{user}', [ConversationController::class, 'show'])->name('show');
        Route::get('/with/{user}/poll', [ConversationController::class, 'poll'])->name('poll');
        Route::post('/with/{user}', [ConversationController::class, 'store'])->name('store');
    });

    Route::middleware('role:'.User::ROLE_CLIENT)->prefix('client')->name('client.')->group(function () {
        Route::get('/dashboard', [ClientDashboardController::class, 'index'])->name('dashboard');
        Route::get('/settings', [PortalSettingsController::class, 'index'])->name('settings');
        Route::get('/orders', [ClientOrderController::class, 'index'])->name('orders.index');
        Route::post('/orders', [ClientOrderController::class, 'store'])->name('orders.store');
        Route::patch('/orders/{order}', [ClientOrderController::class, 'update'])->name('orders.update');
        Route::delete('/orders/{order}', [ClientOrderController::class, 'destroy'])->name('orders.destroy');

        Route::prefix('demandes')->name('demandes.')->group(function () {
            Route::get('/', [ClientDemandeViewController::class, 'index'])->name('index');
            Route::get('/{demande}', [ClientDemandeViewController::class, 'show'])->name('show');
            Route::post('/', [DemandeController::class, 'store'])->name('store');
            Route::put('/{demande}', [DemandeController::class, 'update'])->name('update');
            Route::delete('/{demande}', [DemandeController::class, 'destroy'])->name('destroy');
        });

        Route::get('/suppliers', fn () => redirect()->route('marketplace.suppliers.index'))->name('suppliers.index');
        Route::get('/suppliers/{supplier}', function (User $supplier) {
            $profile = $supplier->supplierProfile ?? \App\Models\SupplierProfile::ensureFor($supplier);

            return redirect()->route('marketplace.suppliers.show', $profile);
        })->name('suppliers.show');

        Route::get('/favorites', [ClientFavoriteController::class, 'index'])->name('favorites.index');
        Route::post('/favorites/{supplier}', [ClientFavoriteController::class, 'store'])->name('favorites.store');
        Route::delete('/favorites/{supplier}', [ClientFavoriteController::class, 'destroy'])->name('favorites.destroy');

        Route::prefix('offres')->name('offers.')->group(function () {
            Route::get('/', [ClientOfferController::class, 'index'])->name('index');
            Route::post('/{offre}/accept', [ClientOfferController::class, 'accept'])->name('accept');
            Route::post('/{offre}/reject', [ClientOfferController::class, 'reject'])->name('reject');
        });
    });

    Route::middleware('role:'.User::ROLE_SUPPLIER)->prefix('supplier')->name('supplier.')->group(function () {
        Route::get('/dashboard', [SupplierDashboardController::class, 'index'])->name('dashboard');
        Route::get('/settings', [PortalSettingsController::class, 'index'])->name('settings');
        Route::get('/demandes', [SupplierDemandeController::class, 'index'])->name('demandes.index');
        Route::get('/demandes/{demande}/quote', [SupplierQuotationController::class, 'create'])->name('demandes.quote');
        Route::post('/demandes/{demande}/quote', [SupplierQuotationController::class, 'store'])->name('demandes.quote.store');
        Route::get('/orders', [SupplierOrderController::class, 'index'])->name('orders.index');
        Route::patch('/orders/{order}', [SupplierOrderController::class, 'update'])->name('orders.update');
        Route::get('/offers', [SupplierOffersController::class, 'index'])->name('offers');
        Route::get('/offers/export', [SupplierOffersController::class, 'export'])->name('offers.export');
        Route::get('/profile', [SupplierProfileController::class, 'show'])->name('profile');
        Route::get('/profile/edit', [SupplierProfileController::class, 'edit'])->name('profile.edit');
        Route::put('/profile', [SupplierProfileController::class, 'update'])->name('profile.update');
        Route::resource('products', SupplierProductController::class)->except(['show']);
    });

    Route::middleware('role:'.User::ROLE_ADMIN)->prefix('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminDashboardController::class, 'index'])->name('dashboard');
        Route::get('/statistics', [AdminStatisticsController::class, 'index'])->name('statistics');

        Route::get('/users', [AdminUserController::class, 'index'])->name('users.index');
        Route::get('/users/create', [AdminUserController::class, 'create'])->name('users.create');
        Route::post('/users', [AdminUserController::class, 'store'])->name('users.store');
        Route::get('/users/{user}', [AdminUserController::class, 'show'])->name('users.show');
        Route::get('/users/{user}/edit', [AdminUserController::class, 'edit'])->name('users.edit');
        Route::put('/users/{user}', [AdminUserController::class, 'update'])->name('users.update');
        Route::patch('/users/{user}/suspend', [AdminUserController::class, 'suspend'])->name('users.suspend');
        Route::patch('/users/{user}/activate', [AdminUserController::class, 'activate'])->name('users.activate');
        Route::delete('/users/{user}', [AdminUserController::class, 'destroy'])->name('users.destroy');

        Route::get('/moderation', [AdminModerationController::class, 'index'])->name('moderation');
        Route::get('/moderation/{document}', [AdminModerationController::class, 'show'])->name('moderation.show');
        Route::patch('/moderation/{document}/approve', [AdminModerationController::class, 'approve'])->name('moderation.approve');
        Route::patch('/moderation/{document}/reject', [AdminModerationController::class, 'reject'])->name('moderation.reject');

        Route::get('/products', [AdminProductController::class, 'index'])->name('products.index');
        Route::get('/products/create', [AdminProductController::class, 'create'])->name('products.create');
        Route::post('/products', [AdminProductController::class, 'store'])->name('products.store');
        Route::get('/products/{product}/edit', [AdminProductController::class, 'edit'])->name('products.edit');
        Route::put('/products/{product}', [AdminProductController::class, 'update'])->name('products.update');
        Route::delete('/products/{product}', [AdminProductController::class, 'destroy'])->name('products.destroy');

        Route::get('/demandes', [AdminDemandeController::class, 'index'])->name('demandes.index');
        Route::get('/demandes/create', [AdminDemandeController::class, 'create'])->name('demandes.create');
        Route::post('/demandes', [AdminDemandeController::class, 'store'])->name('demandes.store');
        Route::get('/demandes/{demande}', [AdminDemandeController::class, 'show'])->name('demandes.show');
        Route::get('/demandes/{demande}/edit', [AdminDemandeController::class, 'edit'])->name('demandes.edit');
        Route::put('/demandes/{demande}', [AdminDemandeController::class, 'update'])->name('demandes.update');
        Route::delete('/demandes/{demande}', [AdminDemandeController::class, 'destroy'])->name('demandes.destroy');

        Route::get('/offers', [AdminOfferController::class, 'index'])->name('offers.index');
        Route::get('/offers/{offre}', [AdminOfferController::class, 'show'])->name('offers.show');
        Route::delete('/offers/{offre}', [AdminOfferController::class, 'destroy'])->name('offers.destroy');

        Route::get('/orders', [AdminOrderController::class, 'index'])->name('orders.index');
        Route::get('/orders/{order}', [AdminOrderController::class, 'show'])->name('orders.show');
        Route::patch('/orders/{order}', [AdminOrderController::class, 'update'])->name('orders.update');

        Route::get('/messages', [AdminMessageController::class, 'index'])->name('messages.index');

        Route::get('/settings', [AdminSettingsController::class, 'index'])->name('settings');
    });

    Route::redirect('/demande', '/client/demandes');
    Route::get('/demande/{demande}', fn (\App\Models\Demande $demande) => redirect()->route('client.demandes.show', $demande));
    Route::redirect('/offres', '/client/offres');
    Route::redirect('/suppliers', '/client/suppliers');
    Route::redirect('/admin', '/admin/dashboard');
});

require __DIR__.'/auth.php';
