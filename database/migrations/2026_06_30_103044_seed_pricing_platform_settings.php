<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Support\Facades\DB;

return new class extends Migration
{
    public function up(): void
    {
        $defaults = [
            'price_monthly' => '100',
            'price_annual'  => '1000',
            'monthly_features' => json_encode([
                'Full public listing on Kids Health Hub',
                'Appear in search results & category pages',
                'Telehealth badge & availability toggle',
                'Families can view and enquire directly',
                'Profile with photos, bio & services',
                'Appointment request management',
                'Analytics — profile views dashboard',
                'Cancel anytime, no lock-in',
            ]),
            'annual_features' => json_encode([
                'Everything in Monthly',
                'Priority placement in search results',
                'Featured provider badge on your profile',
                '2 months free vs monthly billing',
                'Annual invoice for easy bookkeeping',
                'Dedicated onboarding support',
            ]),
            'comparison_rows' => json_encode([
                ['label' => 'Public provider listing',      'monthly' => true,  'annual' => true],
                ['label' => 'Search & category visibility', 'monthly' => true,  'annual' => true],
                ['label' => 'Telehealth badge',             'monthly' => true,  'annual' => true],
                ['label' => 'Availability toggle',          'monthly' => true,  'annual' => true],
                ['label' => 'Appointment requests',         'monthly' => true,  'annual' => true],
                ['label' => 'Profile views analytics',      'monthly' => true,  'annual' => true],
                ['label' => 'Priority search placement',    'monthly' => false, 'annual' => true],
                ['label' => 'Featured provider badge',      'monthly' => false, 'annual' => true],
                ['label' => 'Annual invoice',               'monthly' => false, 'annual' => true],
                ['label' => 'Onboarding support',           'monthly' => false, 'annual' => true],
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
            'price_monthly', 'price_annual',
            'monthly_features', 'annual_features', 'comparison_rows',
        ])->delete();
    }
};
