<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\PlatformSetting;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class AdminPricingController extends Controller
{
    public function index(): View
    {
        $priceSole        = PlatformSetting::get('price_sole',     140);
        $priceStandard    = PlatformSetting::get('price_standard', 250);
        $priceFeatured    = PlatformSetting::get('price_featured', 450);
        $priceAddon       = PlatformSetting::get('price_addon_category', 50);
        $soleFeatures     = json_decode(PlatformSetting::get('sole_features',     '[]'), true) ?? [];
        $standardFeatures = json_decode(PlatformSetting::get('standard_features', '[]'), true) ?? [];
        $featuredExtras   = json_decode(PlatformSetting::get('featured_extras',   '[]'), true) ?? [];

        return view('admin.pricing', compact(
            'priceSole', 'priceStandard', 'priceFeatured', 'priceAddon',
            'soleFeatures', 'standardFeatures', 'featuredExtras'
        ));
    }

    public function update(Request $request): RedirectResponse
    {
        $validated = $request->validate([
            'price_sole'           => ['required', 'integer', 'min:1'],
            'price_standard'       => ['required', 'integer', 'min:1'],
            'price_featured'       => ['required', 'integer', 'min:1'],
            'price_addon_category' => ['required', 'integer', 'min:0'],
            'sole_features'        => ['nullable', 'array'],
            'sole_features.*'      => ['string', 'max:255'],
            'standard_features'    => ['nullable', 'array'],
            'standard_features.*'  => ['string', 'max:255'],
            'featured_extras'      => ['nullable', 'array'],
            'featured_extras.*'    => ['string', 'max:255'],
        ]);

        PlatformSetting::set('price_sole',           $validated['price_sole']);
        PlatformSetting::set('price_standard',       $validated['price_standard']);
        PlatformSetting::set('price_featured',       $validated['price_featured']);
        PlatformSetting::set('price_addon_category', $validated['price_addon_category']);

        PlatformSetting::set('sole_features',     json_encode(array_values(array_filter($validated['sole_features']     ?? []))));
        PlatformSetting::set('standard_features', json_encode(array_values(array_filter($validated['standard_features'] ?? []))));
        PlatformSetting::set('featured_extras',   json_encode(array_values(array_filter($validated['featured_extras']   ?? []))));

        return back()->with('success', 'Pricing settings saved.');
    }
}
