<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
            'price_sole'     => '140',
            'price_standard' => '250',
            'price_featured' => '450',
            'price_addon_category' => '50',

            'sole_features' => json_encode([
                'Listing under one professional discipline',
                '12 months membership',
                'Business / service description',
                'Contact information and website links',
                'Unlimited family enquiries',
                'DIY updates to your business profile',
                'Welcome post on Kids Health Hub social media',
            ]),

            'standard_features' => json_encode([
                'Listing across up to two professional disciplines',
                '12 months membership',
                'Business / service description',
                'Contact information and website links',
                'Unlimited family enquiries',
                'DIY updates to your business profile',
                'Welcome post on Kids Health Hub social media',
            ]),

            'featured_extras' => json_encode([
                'Everything in the Standard Listing, plus:',
                'Top-tier directory placement in search results',
                'Exclusive provider feature across our social media platforms',
                'Featured Provider badge displayed on your profile',
                'Placement on the Kids Health Hub homepage (Featured Providers section)',
            ]),
        ];

        foreach ($defaults as $key => $value) {
            DB::table('platform_settings')->updateOrInsert(
                ['key' => $key],
                ['value' => $value, 'updated_at' => now(), 'created_at' => now()]
            );
        }
    }

    public function down(): void
    {
        DB::table('platform_settings')->whereIn('key', [
            'price_sole', 'price_standard', 'price_featured', 'price_addon_category',
            'sole_features', 'standard_features', 'featured_extras',
        ])->delete();
    }
};
