<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformSetting;
use App\Models\Provider;
use App\Models\ProviderView;
use App\Models\Subscription;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminDashboardController extends Controller
{
    public function index(): View
    {
        $stats = [
            'pending'   => Provider::where('approval_status', 'pending')->count(),
            'approved'  => Provider::where('approval_status', 'approved')->count(),
            'rejected'  => Provider::where('approval_status', 'rejected')->count(),
            'total'     => Provider::count(),
            'trial'     => Subscription::where('status', 'trial')->count(),
            'active'    => Subscription::where('status', 'active')->count(),
            'expired'   => Subscription::where('status', 'expired')->count(),
            'featured'  => Provider::where('is_featured', true)->count(),
        ];

        $pendingProviders = Provider::where('approval_status', 'pending')
            ->with('user', 'categories')
            ->latest()
            ->limit(5)
            ->get();

        $topViewedProviders = Provider::select('providers.*')
            ->selectSub(
                ProviderView::selectRaw('count(*)')
                    ->whereColumn('provider_id', 'providers.id'),
                'views_count'
            )
            ->orderByDesc('views_count')
            ->limit(5)
            ->get();

        $trialDuration = PlatformSetting::get('trial_duration_months', 3);

        return view('admin.dashboard', compact('stats', 'pendingProviders', 'topViewedProviders', 'trialDuration'));
    }

    public function guide(): View
    {
        return view('admin.guide');
    }

    public function updateSettings(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'trial_duration_months'  => ['required', 'integer', 'min:1', 'max:24'],
            'homepage_hero_title'    => ['required', 'string', 'max:255'],
            'homepage_hero_subtitle' => ['nullable', 'string', 'max:500'],
        ]);

        foreach ($validated as $key => $value) {
            PlatformSetting::set($key, $value);
        }

        return back()->with('success', 'Settings updated.');
    }
}
