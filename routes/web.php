<?php

use App\Http\Controllers\ProfileController;
use App\Http\Controllers\DocumentVerificationController;
use App\Http\Controllers\DemandeController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\OffreController;
use App\Http\Controllers\OrderController;
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    Route::apiResource('demandes', DemandeController::class);
    Route::apiResource('offres', OffreController::class);
    Route::apiResource('orders', OrderController::class);
    Route::apiResource('notifications', NotificationController::class);
    Route::apiResource('messages', MessageController::class);
    Route::apiResource('document-verifications', DocumentVerificationController::class);
});

require __DIR__.'/auth.php';
