<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\Review;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;

class FamilyReviewController extends Controller
{
    public function store(Request $request, Provider $provider): RedirectResponse
    {
        $request->validate([
            'rating' => ['required', 'integer', 'min:1', 'max:5'],
            'body'   => ['required', 'string', 'min:10', 'max:1000'],
        ]);

        $user = auth()->user();

        $existing = Review::where('user_id', $user->id)
            ->where('provider_id', $provider->id)
            ->first();

        if ($existing) {
            return back()->with('error', 'You have already submitted a review for this provider.');
        }

        Review::create([
            'user_id'     => $user->id,
            'provider_id' => $provider->id,
            'rating'      => $request->rating,
            'body'        => $request->body,
            'status'      => 'pending',
        ]);

        return back()->with('success', 'Your review has been submitted and is awaiting approval. Thank you!');
    }
}
