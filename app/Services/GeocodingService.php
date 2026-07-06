<?php

namespace App\Services;

use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\Log;

class GeocodingService
{
    /** Status/error message from the most recent geocode() call — set on both success and failure. */
    public string $lastStatus = '';

    public function geocode(?string $address, ?string $suburb, ?string $state, ?string $postcode): ?array
    {
        $parts = array_filter([$address, $suburb, $state, $postcode]);

        if (empty($parts)) {
            $this->lastStatus = 'No address fields provided';
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
                $this->lastStatus = 'OK';
                return [
                    'latitude'  => $location['lat'],
                    'longitude' => $location['lng'],
                ];
            }

            $this->lastStatus = ($data['status'] ?? 'UNKNOWN_ERROR') . (!empty($data['error_message']) ? ' — ' . $data['error_message'] : '');
            Log::warning('Geocoding failed', ['query' => $query, 'status' => $data['status'] ?? 'unknown', 'error_message' => $data['error_message'] ?? null]);
        } catch (\Exception $e) {
            $this->lastStatus = 'EXCEPTION — ' . $e->getMessage();
            Log::error('Geocoding exception', ['message' => $e->getMessage()]);
        }

        return null;
    }
}
