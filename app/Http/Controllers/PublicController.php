<?php

namespace App\Http\Controllers;

use App\Models\Category;
use App\Models\PlatformSetting;
use App\Models\Provider;
use App\Models\ProviderView;
use App\Models\Review;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PublicController extends Controller
{
    public function home(): View
    {
        $featuredProviders = Provider::publiclyVisible()
            ->featured()
            ->with(['categories', 'subscription'])
            ->withAvg(['reviews as avg_rating' => fn ($q) => $q->where('status', 'approved')], 'rating')
            ->withCount(['reviews as review_count' => fn ($q) => $q->where('status', 'approved')])
            ->limit(6)
            ->get();

        $recentProviders = Provider::publiclyVisible()
            ->with(['categories', 'subscription'])
            ->withAvg(['reviews as avg_rating' => fn ($q) => $q->where('status', 'approved')], 'rating')
            ->withCount(['reviews as review_count' => fn ($q) => $q->where('status', 'approved')])
            ->latest()
            ->limit(12)
            ->get();

        $categories  = Category::where('is_active', true)->orderBy('sort_order')->get();
        $heroTitle   = PlatformSetting::get('homepage_hero_title', 'Find Child Healthcare Providers Near You');
        $heroSubtitle = PlatformSetting::get('homepage_hero_subtitle', '');

        return view('public.home', compact(
            'featuredProviders', 'recentProviders', 'categories', 'heroTitle', 'heroSubtitle'
        ));
    }

    public function providers(Request $request): View
    {
        $query = Provider::publiclyVisible()
            ->with(['categories', 'subscription'])
            ->withAvg(['reviews as avg_rating' => fn ($q) => $q->where('status', 'approved')], 'rating')
            ->withCount(['reviews as review_count' => fn ($q) => $q->where('status', 'approved')]);

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                    ->orWhere('provider_name', 'like', "%{$search}%")
                    ->orWhere('suburb', 'like', "%{$search}%")
                    ->orWhere('postcode', 'like', "%{$search}%");
            });
        }

        if ($category = $request->input('category')) {
            $query->whereHas('categories', fn ($q) => $q->where('slug', $category));
        }

        if ($request->boolean('telehealth')) {
            $query->telehealth();
        }

        if ($request->boolean('available')) {
            $query->available();
        }

        if ($ageGroup = $request->input('age_group')) {
            $query->whereJsonContains('age_groups', $ageGroup);
        }

        if ($fundingType = $request->input('funding_type')) {
            $query->whereJsonContains('funding_types', $fundingType);
        }

        if ($delivery = $request->input('service_delivery')) {
            $query->whereJsonContains('service_delivery', $delivery);
        }

        $lat    = $request->input('lat');
        $lng    = $request->input('lng');
        $radius = (int) $request->input('radius', 25);

        if ($lat && $lng) {
            $query->selectRaw(
                'providers.*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$lat, $lng, $lat]
            )
            ->whereNotNull('latitude')
            ->whereNotNull('longitude')
            ->having('distance', '<=', $radius)
            ->orderBy('distance');
        } else {
            $query->orderByDesc('is_featured')->latest();
        }

        $providers  = $query->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('public.providers', compact('providers', 'categories'));
    }

    public function show(Request $request, Provider $provider): View
    {
        abort_unless($provider->isPubliclyVisible(), 404);

        $provider->load(['categories', 'subscription', 'user']);

        $this->trackView($request, $provider);

        $reviews = Review::with('user')
            ->where('provider_id', $provider->id)
            ->where('status', 'approved')
            ->latest()
            ->get();

        $avgRating   = $reviews->avg('rating');
        $reviewCount = $reviews->count();

        $userReview = auth()->check()
            ? Review::where('user_id', auth()->id())->where('provider_id', $provider->id)->first()
            : null;

        return view('public.provider-profile', compact('provider', 'reviews', 'avgRating', 'reviewCount', 'userReview'));
    }

    private function trackView(Request $request, Provider $provider): void
    {
        // Skip if the logged-in user owns this provider listing
        if (auth()->check() && auth()->user()->provider?->id === $provider->id) {
            return;
        }

        ProviderView::create([
            'provider_id' => $provider->id,
            'ip_hash'     => hash('sha256', $request->ip()),
            'viewed_at'   => now(),
        ]);
    }

    public function telehealth(Request $request): View
    {
        $query = Provider::publiclyVisible()->telehealth()
            ->with(['categories', 'subscription'])
            ->withAvg(['reviews as avg_rating' => fn ($q) => $q->where('status', 'approved')], 'rating')
            ->withCount(['reviews as review_count' => fn ($q) => $q->where('status', 'approved')]);

        if ($category = $request->input('category')) {
            $query->whereHas('categories', fn ($q) => $q->where('slug', $category));
        }

        $providers  = $query->orderByDesc('is_featured')->latest()->paginate(12)->withQueryString();
        $categories = Category::where('is_active', true)->orderBy('sort_order')->get();

        return view('public.telehealth', compact('providers', 'categories'));
    }

    public function apiProviders(Request $request): JsonResponse
    {
        $query = Provider::publiclyVisible()
            ->with(['categories'])
            ->whereNotNull('latitude')
            ->whereNotNull('longitude');

        if ($search = $request->input('search')) {
            $query->where(function ($q) use ($search) {
                $q->where('business_name', 'like', "%{$search}%")
                    ->orWhere('suburb', 'like', "%{$search}%")
                    ->orWhere('postcode', 'like', "%{$search}%");
            });
        }

        if ($category = $request->input('category')) {
            $query->whereHas('categories', fn ($q) => $q->where('slug', $category));
        }

        if ($request->boolean('telehealth')) {
            $query->telehealth();
        }

        if ($request->boolean('available')) {
            $query->available();
        }

        $lat    = $request->input('lat');
        $lng    = $request->input('lng');
        $radius = (int) $request->input('radius', 25);

        if ($lat && $lng) {
            $query->selectRaw(
                'providers.*, (6371 * acos(cos(radians(?)) * cos(radians(latitude)) * cos(radians(longitude) - radians(?)) + sin(radians(?)) * sin(radians(latitude)))) AS distance',
                [$lat, $lng, $lat]
            )
            ->having('distance', '<=', $radius)
            ->orderBy('distance');
        }

        $providers = $query->get()->map(fn ($p) => [
            'id'                   => $p->id,
            'slug'                 => $p->slug,
            'business_name'        => $p->business_name,
            'provider_name'        => $p->provider_name,
            'suburb'               => $p->suburb,
            'state'                => $p->state,
            'latitude'             => (float) $p->latitude,
            'longitude'            => (float) $p->longitude,
            'telehealth_available' => $p->telehealth_available,
            'availability_status'  => $p->availability_status,
            'is_featured'          => $p->is_featured,
            'profile_image'        => $p->profile_image ? asset('storage/' . $p->profile_image) : null,
            'categories'           => $p->categories->pluck('name'),
            'url'                  => route('providers.show', $p->slug),
        ]);

        return response()->json($providers);
    }

    public function about(): View
    {
        return view('public.about');
    }

    public function pricing(): View
    {
        $priceMonthly    = (int) PlatformSetting::get('price_monthly', 100);
        $priceAnnual     = (int) PlatformSetting::get('price_annual', 1000);
        $trialMonths     = (int) PlatformSetting::get('trial_duration_months', 3);
        $monthlyFeatures = json_decode(PlatformSetting::get('monthly_features', '[]'), true) ?? [];
        $annualFeatures  = json_decode(PlatformSetting::get('annual_features',  '[]'), true) ?? [];
        $comparisonRows  = json_decode(PlatformSetting::get('comparison_rows',  '[]'), true) ?? [];

        $annualPerMonth = $priceAnnual > 0 ? round($priceAnnual / 12) : 0;
        $annualSavings  = ($priceMonthly * 12) - $priceAnnual;

        return view('public.pricing', compact(
            'priceMonthly', 'priceAnnual', 'trialMonths',
            'monthlyFeatures', 'annualFeatures', 'comparisonRows',
            'annualPerMonth', 'annualSavings'
        ));
    }

    public function guide(): View
    {
        return view('public.guide');
    }

    public function guideFamilies(): View
    {
        return view('public.guide-families');
    }

    public function guideProviders(): View
    {
        return view('public.guide-providers');
    }

    public function guideFaq(): View
    {
        return view('public.guide-faq');
    }
}
