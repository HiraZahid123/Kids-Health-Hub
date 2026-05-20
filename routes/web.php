<?php

use App\Http\Controllers\Admin\AdminDashboardController;
use App\Http\Controllers\Admin\AdminProviderController;
use App\Http\Controllers\Admin\AdminReviewController;
use App\Http\Controllers\Admin\AdminSubscriptionController;
use App\Http\Controllers\Family\FamilyAppointmentController;
use App\Http\Controllers\Family\FamilyDashboardController;
use App\Http\Controllers\Family\FamilyReviewController;
use App\Http\Controllers\Family\FamilySavedController;
use App\Http\Controllers\Provider\ProviderAppointmentController;
use App\Http\Controllers\Provider\ProviderDashboardController;
use App\Http\Controllers\Provider\ProviderProfileController;
use App\Http\Controllers\Provider\StripeCheckoutController;
use App\Http\Controllers\MessageController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/providers', [PublicController::class, 'providers'])->name('providers.index');
Route::get('/providers/{provider:slug}', [PublicController::class, 'show'])->name('providers.show');
Route::get('/telehealth', [PublicController::class, 'telehealth'])->name('telehealth');
Route::get('/api/providers', [PublicController::class, 'apiProviders'])->name('api.providers');

// Role-based dashboard redirect (used by Breeze after login)
Route::get('/dashboard', function () {
    if (auth()->user()->isAdmin())    return redirect()->route('admin.dashboard');
    if (auth()->user()->isFamily())   return redirect()->route('family.dashboard');
    return redirect()->route('provider.dashboard');
})->middleware('auth')->name('dashboard');

// Family dashboard
Route::middleware(['auth', 'role:family'])->prefix('family')->name('family.')->group(function () {
    Route::get('/dashboard', [FamilyDashboardController::class, 'index'])->name('dashboard');

    Route::get('/saved',               [FamilySavedController::class, 'index'])->name('saved');
    Route::post('/saved/{provider}',   [FamilySavedController::class, 'toggle'])->name('saved.toggle');
    Route::post('/reviews/{provider}',      [FamilyReviewController::class, 'store'])->name('reviews.store');
    Route::get('/appointments',             [FamilyAppointmentController::class, 'index'])->name('appointments.index');
    Route::post('/appointments/{provider}', [FamilyAppointmentController::class, 'store'])->name('appointments.store');

    Route::get('/messages',                        [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{appointment}',          [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{appointment}',         [MessageController::class, 'store'])->name('messages.store');
});

// Provider dashboard
Route::middleware(['auth', 'role:provider'])->prefix('provider')->name('provider.')->group(function () {
    Route::get('/dashboard', [ProviderDashboardController::class, 'index'])->name('dashboard');
    Route::get('/profile', [ProviderProfileController::class, 'edit'])->name('profile.edit');
    Route::put('/profile', [ProviderProfileController::class, 'update'])->name('profile.update');
    Route::post('/profile/image', [ProviderProfileController::class, 'uploadImage'])->name('profile.image');
    Route::patch('/availability', [ProviderProfileController::class, 'toggleAvailability'])->name('availability.toggle');
    Route::patch('/telehealth', [ProviderProfileController::class, 'toggleTelehealth'])->name('telehealth.toggle');
    Route::post('/checkout', [StripeCheckoutController::class, 'store'])->name('checkout.store');
    Route::get('/checkout/success', [StripeCheckoutController::class, 'success'])->name('checkout.success');
    Route::get('/appointments',                         [ProviderAppointmentController::class, 'index'])->name('appointments.index');
    Route::patch('/appointments/{appointment}/respond', [ProviderAppointmentController::class, 'respond'])->name('appointments.respond');
    Route::get('/messages',                             [MessageController::class, 'index'])->name('messages.index');
    Route::get('/messages/{appointment}',               [MessageController::class, 'show'])->name('messages.show');
    Route::post('/messages/{appointment}',              [MessageController::class, 'store'])->name('messages.store');
});

// Stripe webhook (no auth, no CSRF — excluded in bootstrap/app.php)
Route::post('/stripe/webhook', [StripeWebhookController::class, 'handle'])->name('stripe.webhook');

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
    Route::get('/reviews', [AdminReviewController::class, 'index'])->name('reviews.index');
    Route::patch('/reviews/{review}/approve', [AdminReviewController::class, 'approve'])->name('reviews.approve');
    Route::patch('/reviews/{review}/reject',  [AdminReviewController::class, 'reject'])->name('reviews.reject');
    Route::patch('/settings', [AdminDashboardController::class, 'updateSettings'])->name('settings.update');
});

Route::get('/fix-storage-link', function () {
    $target = storage_path('app/public');
    $link = public_path('storage');

    // 1. Clean up any existing file or broken link first
    if (file_exists($link) || is_link($link)) {
        @unlink($link);
    }

    // 2. Use pure PHP symlink function completely outside Laravel's filesystem system
    if (symlink($target, $link)) {
        return 'Storage link created successfully using pure PHP!';
    } else {
        return 'Failed to create link. Your hosting provider might have symlink disabled completely.';
    }
});

require __DIR__ . '/auth.php';
