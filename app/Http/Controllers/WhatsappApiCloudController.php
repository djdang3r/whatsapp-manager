<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class WhatsappApiCloudController extends Controller
{
    private function fetchPhoneNumbers($api_token, $whatsapp_business_id)
    {
        $api_url = rtrim(env('WHATSAPP_API_URL'), '/');
        $api_version = env('WHATSAPP_API_VERSION');
        $url = "{$api_url}/{$api_version}/{$whatsapp_business_id}/phone_numbers";
        // Log::info("Fetching phone numbers from URL: " . $url);

        $response = Http::withToken($api_token)->get($url);

        // dd($response->json()['data']);
        if ($response->successful()) {
            return $response->json()['data'];
        } else {
            throw new \Exception("Failed to fetch phone numbers: " . $response->body());
        }
    }
}
