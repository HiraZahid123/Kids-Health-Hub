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

        $trialDuration   = PlatformSetting::get('trial_duration_months', 3);
        $priceSole       = PlatformSetting::get('price_sole',     140);
        $priceStandard   = PlatformSetting::get('price_standard', 250);
        $priceFeatured   = PlatformSetting::get('price_featured', 450);
        $priceAddon      = PlatformSetting::get('price_addon_category', 50);
        $soleFeatures    = json_decode(PlatformSetting::get('sole_features',     '[]'), true) ?? [];
        $standardFeatures= json_decode(PlatformSetting::get('standard_features', '[]'), true) ?? [];
        $featuredExtras  = json_decode(PlatformSetting::get('featured_extras',   '[]'), true) ?? [];

        return view('admin.dashboard', compact(
            'stats', 'pendingProviders', 'topViewedProviders',
            'trialDuration',
            'priceSole', 'priceStandard', 'priceFeatured', 'priceAddon',
            'soleFeatures', 'standardFeatures', 'featuredExtras'
        ));
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
            'price_sole'             => ['required', 'integer', 'min:1'],
            'price_standard'         => ['required', 'integer', 'min:1'],
            'price_featured'         => ['required', 'integer', 'min:1'],
            'price_addon_category'   => ['required', 'integer', 'min:0'],
            'sole_features'          => ['nullable', 'array'],
            'sole_features.*'        => ['string', 'max:255'],
            'standard_features'      => ['nullable', 'array'],
            'standard_features.*'    => ['string', 'max:255'],
            'featured_extras'        => ['nullable', 'array'],
            'featured_extras.*'      => ['string', 'max:255'],
        ]);

        PlatformSetting::set('trial_duration_months',  $validated['trial_duration_months']);
        PlatformSetting::set('homepage_hero_title',    $validated['homepage_hero_title']);
        PlatformSetting::set('homepage_hero_subtitle', $validated['homepage_hero_subtitle'] ?? '');
        PlatformSetting::set('price_sole',             $validated['price_sole']);
        PlatformSetting::set('price_standard',         $validated['price_standard']);
        PlatformSetting::set('price_featured',         $validated['price_featured']);
        PlatformSetting::set('price_addon_category',   $validated['price_addon_category']);

        PlatformSetting::set('sole_features',     json_encode(array_values(array_filter($validated['sole_features']     ?? []))));
        PlatformSetting::set('standard_features', json_encode(array_values(array_filter($validated['standard_features'] ?? []))));
        PlatformSetting::set('featured_extras',   json_encode(array_values(array_filter($validated['featured_extras']   ?? []))));

        return back()->with('success', 'Settings updated.');
    }
}
