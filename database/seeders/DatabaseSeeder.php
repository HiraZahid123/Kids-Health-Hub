<?php

namespace Database\Seeders;

use App\Models\Category;
use App\Models\PlatformSetting;
use App\Models\User;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Hash;
use Spatie\Permission\Models\Role;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        // Roles
        $adminRole    = Role::firstOrCreate(['name' => 'admin']);
        $providerRole = Role::firstOrCreate(['name' => 'provider']);

        // Admin user
        $admin = User::firstOrCreate(
            ['email' => 'admin@kidshealthhub.com.au'],
            [
                'name'     => 'Platform Admin',
                'password' => Hash::make('Admin@12345'),
            ]
        );
        $admin->assignRole($adminRole);

        // Default categories
        $categories = [
            ['name' => 'Speech Pathology',       'slug' => 'speech-pathology'],
            ['name' => 'Occupational Therapy',    'slug' => 'occupational-therapy'],
            ['name' => 'Psychology',              'slug' => 'psychology'],
            ['name' => 'Physiotherapy',           'slug' => 'physiotherapy'],
            ['name' => 'Paediatrics',             'slug' => 'paediatrics'],
            ['name' => 'Autism Support',          'slug' => 'autism-support'],
            ['name' => 'Child Development',       'slug' => 'child-development'],
            ['name' => 'Dietetics & Nutrition',   'slug' => 'dietetics-nutrition'],
        ];

        foreach ($categories as $i => $cat) {
            Category::firstOrCreate(
                ['slug' => $cat['slug']],
                ['name' => $cat['name'], 'sort_order' => $i + 1]
            );
        }

        // Platform settings
        PlatformSetting::set('trial_duration_months', '3');
        PlatformSetting::set('homepage_hero_title', 'Find Child Healthcare Providers Near You');
        PlatformSetting::set('homepage_hero_subtitle', 'Connecting families with trusted therapists and healthcare professionals across Australia.');
    }
}
