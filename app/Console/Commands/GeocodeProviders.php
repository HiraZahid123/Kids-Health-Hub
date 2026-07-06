<?php

namespace App\Console\Commands;

use App\Models\Provider;
use App\Services\GeocodingService;
use Illuminate\Console\Command;

class GeocodeProviders extends Command
{
    protected $signature   = 'providers:geocode {--force : Re-geocode providers that already have coordinates}';
    protected $description = 'Backfill latitude/longitude for providers missing map coordinates';

    public function handle(GeocodingService $geocoder): int
    {
        $query = Provider::query();

        if (! $this->option('force')) {
            $query->whereNull('latitude')->orWhereNull('longitude');
        }

        $providers = $query->get();

        if ($providers->isEmpty()) {
            $this->info('All providers already have coordinates. Use --force to re-geocode.');
            return self::SUCCESS;
        }

        $this->info("Geocoding {$providers->count()} provider(s)...");
        $bar = $this->output->createProgressBar($providers->count());
        $bar->start();

        $success = 0;
        $failed  = 0;

        foreach ($providers as $provider) {
            $coords = $geocoder->geocode(
                $provider->address,
                $provider->suburb,
                $provider->state,
                $provider->postcode,
            );

            if ($coords) {
                $provider->update([
                    'latitude'  => $coords['latitude'],
                    'longitude' => $coords['longitude'],
                ]);
                $success++;
            } else {
                $failed++;
                $this->newLine();
                $this->warn("  Could not geocode: {$provider->business_name} (ID {$provider->id}) — {$provider->suburb}, {$provider->state} {$provider->postcode} — reason: {$geocoder->lastStatus}");
            }

            $bar->advance();
        }

        $bar->finish();
        $this->newLine(2);
        $this->info("Done. {$success} succeeded, {$failed} failed.");

        return self::SUCCESS;
    }
}
