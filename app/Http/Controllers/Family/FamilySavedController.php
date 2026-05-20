<?php

namespace App\Http\Controllers\Family;

use App\Http\Controllers\Controller;
use App\Models\Provider;
use App\Models\SavedProvider;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class FamilySavedController extends Controller
{
    public function index(): View
    {
        $saved = auth()->user()
            ->savedProviders()
            ->with('provider.categories')
            ->latest('saved_providers.created_at')
            ->get()
            ->pluck('provider')
            ->filter();

        return view('family.saved', compact('saved'));
    }

    public function toggle(Request $request, Provider $provider): RedirectResponse
    {
        $user = auth()->user();

        $existing = SavedProvider::where('user_id', $user->id)
            ->where('provider_id', $provider->id)
            ->first();

        if ($existing) {
            $existing->delete();
            $message = 'Provider removed from your saved list.';
        } else {
            SavedProvider::create([
                'user_id'    => $user->id,
                'provider_id' => $provider->id,
            ]);
            $message = 'Provider saved to your list.';
        }

        return back()->with('success', $message);
    }
}
