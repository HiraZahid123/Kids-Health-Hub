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
use App\Http\Controllers\Admin\AdminBlogController;
use App\Http\Controllers\BlogController;
use App\Http\Controllers\CommunityController;
use App\Http\Controllers\PublicController;
use App\Http\Controllers\StripeWebhookController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [PublicController::class, 'home'])->name('home');
Route::get('/providers', [PublicController::class, 'providers'])->name('providers.index');
Route::get('/providers/{provider:slug}', [PublicController::class, 'show'])->name('providers.show');
Route::get('/telehealth', [PublicController::class, 'telehealth'])->name('telehealth');
Route::get('/about', [PublicController::class, 'about'])->name('about');
Route::get('/guide', [PublicController::class, 'guide'])->name('guide');
Route::get('/guide/families', [PublicController::class, 'guideFamilies'])->name('guide.families');
Route::get('/guide/providers', [PublicController::class, 'guideProviders'])->name('guide.providers');
Route::get('/guide/faq', [PublicController::class, 'guideFaq'])->name('guide.faq');

// Blog (public)
Route::get('/blog', [BlogController::class, 'index'])->name('blog.index');
Route::get('/blog/{post:slug}', [BlogController::class, 'show'])->name('blog.show');

// Community (public browse, auth to post/comment/like)
Route::get('/community', [CommunityController::class, 'index'])->name('community.index');
Route::get('/community/{post}', [CommunityController::class, 'show'])->name('community.show');
Route::middleware('auth')->group(function () {
    Route::get('/community/create', [CommunityController::class, 'create'])->name('community.create');
    Route::post('/community', [CommunityController::class, 'store'])->name('community.store');
    Route::get('/community/{post}/edit', [CommunityController::class, 'edit'])->name('community.edit');
    Route::put('/community/{post}', [CommunityController::class, 'update'])->name('community.update');
    Route::delete('/community/{post}', [CommunityController::class, 'destroy'])->name('community.destroy');
    Route::post('/community/{post}/comments', [CommunityController::class, 'storeComment'])->name('community.comments.store');
    Route::delete('/community/comments/{comment}', [CommunityController::class, 'destroyComment'])->name('community.comments.destroy');
    Route::post('/community/{post}/like', [CommunityController::class, 'toggleLike'])->name('community.like');
    Route::get('/community/notifications', [CommunityController::class, 'notifications'])->name('community.notifications');
    Route::patch('/community/{post}/pin', [CommunityController::class, 'pinToggle'])->name('community.pin');
    Route::patch('/community/{post}/lock', [CommunityController::class, 'lockToggle'])->name('community.lock');
});

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
    Route::resource('/blog', AdminBlogController::class)->names('blog');
});

require __DIR__ . '/auth.php';
