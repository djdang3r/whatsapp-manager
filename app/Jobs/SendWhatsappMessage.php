<?php

namespace App\Jobs;

use App\Models\Campaign;
use App\Models\Contact;
use Illuminate\Bus\Batchable;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;

class SendWhatsAppMessage implements ShouldQueue
{
    use Batchable, Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    public $tries = 3;
    public $backoff = 60;

    public function __construct(
        public Campaign $campaign,
        public Contact $contact
    ) {}

    public function handle()
    {
        // Implementación real de la API de WhatsApp
        try {
            $response = $this->sendViaWhatsAppCloudAPI();

            $this->updateContactStatus('DELIVERED', $response);

        } catch (\Exception $e) {
            $this->updateContactStatus('FAILED', $e->getMessage());
            throw $e;
        }
    }

    private function sendViaWhatsAppCloudAPI()
    {
        $client = new \GuzzleHttp\Client();
        $url = sprintf(
            env('WHATSAPP_API_URL', 'https://graph.facebook.com/%s/%s/messages'),
            env('WHATSAPP_API_VERSION', 'v19.0'),
            $this->campaign->businessAccount->phone_number_id
        );

        return $client->post($url, [
            'headers' => [
                'Authorization' => 'Bearer ' . $this->campaign->businessAccount->api_token,
                'Content-Type' => 'application/json'
            ],
            'json' => [
                'messaging_product' => 'whatsapp',
                'to' => $this->contact->phone_number,
                'type' => 'text',
                'text' => [
                    'body' => str_replace(
                        '{nombre}',
                        $this->contact->first_name,
                        $this->campaign->message_content
                    )
                ]
            ]
        ]);
    }

    private function updateContactStatus($status, $response)
    {
        $this->campaign->contacts()->updateExistingPivot($this->contact->contact_id, [
            'status' => $status,
            'delivered_at' => now(),
            'sent_at' => now(),
            'json' => json_encode($response)
        ]);
    }
}
