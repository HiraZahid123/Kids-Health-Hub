<?php

namespace App\Http\Controllers\Provider;

use App\Http\Controllers\Controller;
use App\Models\Category;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\View\View;

class ProviderProfileController extends Controller
{
    public function edit(): View
    {
        $provider   = auth()->user()->provider()->with('categories')->first();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('provider.profile-edit', compact('provider', 'categories'));
    }

    public function update(Request $request): RedirectResponse
    {
        $provider = auth()->user()->provider;

        $validated = $request->validate([
            'business_name'   => ['required', 'string', 'max:255'],
            'provider_name'   => ['required', 'string', 'max:255'],
            'phone'           => ['nullable', 'string', 'max:20'],
            'address'         => ['nullable', 'string', 'max:500'],
            'suburb'          => ['nullable', 'string', 'max:100'],
            'state'           => ['nullable', 'string', 'max:50'],
            'postcode'        => ['nullable', 'string', 'max:10'],
            'bio'             => ['nullable', 'string', 'max:2000'],
            'website_url'     => ['nullable', 'url', 'max:255'],
            'wait_time'       => ['nullable', 'string', 'max:100'],
            'age_groups'      => ['nullable', 'array'],
            'funding_types'   => ['nullable', 'array'],
            'service_delivery' => ['nullable', 'array'],
            'categories'      => ['nullable', 'array'],
            'categories.*'    => ['exists:categories,id'],
        ]);

        $provider->update([
            'business_name'   => $validated['business_name'],
            'provider_name'   => $validated['provider_name'],
            'phone'           => $validated['phone'] ?? null,
            'address'         => $validated['address'] ?? null,
            'suburb'          => $validated['suburb'] ?? null,
            'state'           => $validated['state'] ?? null,
            'postcode'        => $validated['postcode'] ?? null,
            'bio'             => $validated['bio'] ?? null,
            'website_url'     => $validated['website_url'] ?? null,
            'wait_time'       => $validated['wait_time'] ?? null,
            'age_groups'      => $validated['age_groups'] ?? [],
            'funding_types'   => $validated['funding_types'] ?? [],
            'service_delivery' => $validated['service_delivery'] ?? [],
        ]);

        $provider->categories()->sync($validated['categories'] ?? []);

        return back()->with('success', 'Profile updated successfully.');
    }

    public function uploadImage(Request $request): RedirectResponse
    {
        $request->validate([
            'profile_image' => ['required', 'image', 'max:2048'],
        ]);

        $provider = auth()->user()->provider;

        if ($provider->profile_image) {
            Storage::disk('public')->delete($provider->profile_image);
        }

        $path = $request->file('profile_image')->store('provider-images', 'public');
        $provider->update(['profile_image' => $path]);

        return back()->with('success', 'Profile image updated.');
    }

    public function toggleAvailability(Request $request): RedirectResponse
    {
        $provider = auth()->user()->provider;
        $provider->update(['availability_status' => ! $provider->availability_status]);

        return back()->with('success', $provider->availability_status
            ? 'You are now showing as immediately available.'
            : 'Availability status removed.'
        );
    }

    public function toggleTelehealth(Request $request): RedirectResponse
    {
        $provider = auth()->user()->provider;
        $provider->update(['telehealth_available' => ! $provider->telehealth_available]);

        return back()->with('success', $provider->telehealth_available
            ? 'Telehealth services enabled.'
            : 'Telehealth services disabled.'
        );
    }
}
