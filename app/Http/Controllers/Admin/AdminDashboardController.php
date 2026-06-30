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

        $trialDuration    = PlatformSetting::get('trial_duration_months', 3);
        $priceMonthly     = PlatformSetting::get('price_monthly', 100);
        $priceAnnual      = PlatformSetting::get('price_annual', 1000);
        $monthlyFeatures  = json_decode(PlatformSetting::get('monthly_features', '[]'), true) ?? [];
        $annualFeatures   = json_decode(PlatformSetting::get('annual_features',  '[]'), true) ?? [];
        $comparisonRows   = json_decode(PlatformSetting::get('comparison_rows',  '[]'), true) ?? [];

        return view('admin.dashboard', compact(
            'stats', 'pendingProviders', 'topViewedProviders',
            'trialDuration', 'priceMonthly', 'priceAnnual',
            'monthlyFeatures', 'annualFeatures', 'comparisonRows'
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
            'price_monthly'          => ['required', 'integer', 'min:1'],
            'price_annual'           => ['required', 'integer', 'min:1'],
            'monthly_features'       => ['nullable', 'array'],
            'monthly_features.*'     => ['string', 'max:255'],
            'annual_features'        => ['nullable', 'array'],
            'annual_features.*'      => ['string', 'max:255'],
            'comparison_rows'        => ['nullable', 'array'],
            'comparison_rows.*.label'   => ['required', 'string', 'max:255'],
            'comparison_rows.*.monthly' => ['nullable'],
            'comparison_rows.*.annual'  => ['nullable'],
        ]);

        PlatformSetting::set('trial_duration_months',  $validated['trial_duration_months']);
        PlatformSetting::set('homepage_hero_title',    $validated['homepage_hero_title']);
        PlatformSetting::set('homepage_hero_subtitle', $validated['homepage_hero_subtitle'] ?? '');
        PlatformSetting::set('price_monthly',          $validated['price_monthly']);
        PlatformSetting::set('price_annual',           $validated['price_annual']);

        $monthlyFeatures = array_values(array_filter($validated['monthly_features'] ?? []));
        $annualFeatures  = array_values(array_filter($validated['annual_features']  ?? []));

        $comparisonRows = collect($validated['comparison_rows'] ?? [])->map(fn ($row) => [
            'label'   => $row['label'],
            'monthly' => isset($row['monthly']),
            'annual'  => isset($row['annual']),
        ])->values()->all();

        PlatformSetting::set('monthly_features', json_encode($monthlyFeatures));
        PlatformSetting::set('annual_features',  json_encode($annualFeatures));
        PlatformSetting::set('comparison_rows',  json_encode($comparisonRows));

        return back()->with('success', 'Settings updated.');
    }
}
