<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodingService
{
    public function geocode(?string $address, ?string $suburb, ?string $state, ?string $postcode): ?array
    {
        $parts = array_filter([$address, $suburb, $state, $postcode]);

        if (empty($parts)) {
            return null;
        }

        $query = implode(', ', $parts) . ', Australia';

        try {
            $response = Http::get('https://maps.googleapis.com/maps/api/geocode/json', [
                'address' => $query,
                'key'     => config('services.google.geocoding_key'),
            ]);

            $data = $response->json();

            if (($data['status'] ?? '') === 'OK' && !empty($data['results'][0])) {
                $location = $data['results'][0]['geometry']['location'];
                return [
                    'latitude'  => $location['lat'],
                    'longitude' => $location['lng'],
                ];
            }

            Log::warning('Geocoding failed', ['query' => $query, 'status' => $data['status'] ?? 'unknown']);
        } catch (\Exception $e) {
            Log::error('Geocoding exception', ['message' => $e->getMessage()]);
        }

        return null;
    }
}
