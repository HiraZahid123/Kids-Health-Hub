<?php

namespace App\Providers;

use App\View\Composers\SavedProvidersComposer;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\View;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    public function register(): void {}

    public function boot(): void
    {
        Schema::defaultStringLength(191);

        View::composer(
            ['public.providers', 'public.provider-profile', 'public.home', 'public.telehealth'],
            SavedProvidersComposer::class
        );
    }
}
