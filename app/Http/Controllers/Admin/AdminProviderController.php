<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Category;
use App\Models\Provider;
use App\Notifications\ProviderApprovedNotification;
use App\Notifications\ProviderRejectedNotification;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminProviderController extends Controller
{
    public function index(Request $request): View
    {
        $status = $request->input('status', 'pending');

        $providers = Provider::with(['user', 'categories', 'subscription'])
            ->when($status !== 'all', fn ($q) => $q->where('approval_status', $status))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.providers.index', compact('providers', 'status'));
    }

    public function show(Provider $provider): View
    {
        $provider->load(['user', 'categories', 'subscription']);
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('admin.providers.show', compact('provider', 'categories'));
    }

    public function approve(Provider $provider): RedirectResponse
    {
        $provider->update(['approval_status' => 'approved', 'is_active' => true]);

        $provider->user->notify(new ProviderApprovedNotification($provider));

        return back()->with('success', "{$provider->business_name} has been approved.");
    }

    public function reject(Request $request, Provider $provider): RedirectResponse
    {
        $request->validate(['admin_notes' => ['nullable', 'string', 'max:1000']]);

        $provider->update([
            'approval_status' => 'rejected',
            'is_active'       => false,
            'admin_notes'     => $request->input('admin_notes'),
        ]);

        $provider->user->notify(new ProviderRejectedNotification($provider));

        return back()->with('success', "{$provider->business_name} has been rejected.");
    }

    public function suspend(Provider $provider): RedirectResponse
    {
        $provider->update(['is_active' => ! $provider->is_active]);
        $action = $provider->is_active ? 'reactivated' : 'suspended';

        return back()->with('success', "{$provider->business_name} has been {$action}.");
    }

    public function toggleFeatured(Provider $provider): RedirectResponse
    {
        $provider->update(['is_featured' => ! $provider->is_featured]);
        $action = $provider->is_featured ? 'featured' : 'unfeatured';

        return back()->with('success', "{$provider->business_name} has been {$action}.");
    }
}
