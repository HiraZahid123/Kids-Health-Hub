<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProviderController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Provider\ProviderDashboardController;
use App\Http\Controllers\Provider\ProviderProfileController;
use App\Http\Controllers\PublicController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/providers', [PublicController::class, 'providers'])->name('providers.index');
Route::get('/providers/{provider:slug}', [PublicController::class, 'show'])->name('providers.show');
Route::get('/telehealth', [PublicController::class, 'telehealth'])->name('telehealth');
Route::get('/api/providers', [PublicController::class, 'apiProviders'])->name('api.providers');

// Role-based dashboard redirect (used by Breeze after login)
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin()) {
        return redirect()->route('admin.dashboard');
    }
    return redirect()->route('provider.dashboard');
})->middleware('auth')->name('dashboard');

// Provider dashboard
Route::middleware(['auth', 'role:provider'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/dashboard', [ProviderDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProviderProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProviderProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/image', [ProviderProfileController::class, 'uploadImage'])->name('profile.image');
    Route::patch('/availability', [ProviderProfileController::class, 'toggleAvailability'])->name('availability.toggle');
    Route::patch('/telehealth', [ProviderProfileController::class, 'toggleTelehealth'])->name('telehealth.toggle');
});

// Admin dashboard
Route::middleware(['auth', 'role:admin'])->prefix('admin')->name('admin.')->group(function () {
    Route::get('/', [AdminDashboardController::class, 'index'])->name('dashboard');
    Route::get('/providers', [AdminProviderController::class, 'index'])->name('providers.index');
    Route::get('/providers/{provider}', [AdminProviderController::class, 'show'])->name('providers.show');
    Route::patch('/providers/{provider}/approve', [AdminProviderController::class, 'approve'])->name('providers.approve');
    Route::patch('/providers/{provider}/reject', [AdminProviderController::class, 'reject'])->name('providers.reject');
    Route::patch('/providers/{provider}/suspend', [AdminProviderController::class, 'suspend'])->name('providers.suspend');
    Route::patch('/providers/{provider}/feature', [AdminProviderController::class, 'toggleFeatured'])->name('providers.feature');
    Route::get('/subscriptions', [AdminSubscriptionController::class, 'index'])->name('subscriptions.index');
    Route::patch('/settings', [AdminDashboardController::class, 'updateSettings'])->name('settings.update');
});

require __DIR__ . '/auth.php';
