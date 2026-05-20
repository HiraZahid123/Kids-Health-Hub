<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\View\View;

class AdminReviewController extends Controller
{
    public function index(): View
    {
        $pending  = Review::with(['user', 'provider'])->where('status', 'pending')->latest()->get();
        $approved = Review::with(['user', 'provider'])->where('status', 'approved')->latest()->limit(50)->get();
        $rejected = Review::with(['user', 'provider'])->where('status', 'rejected')->latest()->limit(50)->get();

        return view('admin.reviews.index', compact('pending', 'approved', 'rejected'));
    }

    public function approve(Review $review): RedirectResponse
    {
        $review->update(['status' => 'approved']);
        return back()->with('success', 'Review approved and now visible on the provider profile.');
    }

    public function reject(Review $review): RedirectResponse
    {
        $review->update(['status' => 'rejected']);
        return back()->with('success', 'Review rejected.');
    }
}
