<?php

namespace App\Jobs;

use App\Models\Campaign;
use Illuminate\Bus\Batch;
use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Foundation\Bus\Dispatchable;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Queue\SerializesModels;
use Illuminate\Support\Facades\Bus;
use Throwable;

class ProcessCampaignBatch implements ShouldQueue
{
    use Dispatchable, InteractsWithQueue, Queueable, SerializesModels;

    /**
     * Create a new job instance.
     */
    public function __construct(public Campaign $campaign) {}

    /**
     * Execute the job.
     */
    public function handle()
    {
        $contacts = $this->campaign->contacts()
            ->wherePivot('status', 'PENDING')
            ->get();

        $batch = Bus::batch(
            $contacts->map(fn ($contact) => new SendWhatsAppMessage($this->campaign, $contact))
        )->then(function (Batch $batch) {
            // Lógica cuando el batch se completa
            $this->campaign->update(['status' => 'COMPLETED']);
        })->catch(function (Batch $batch, Throwable $e) {
            // Manejar errores
            $this->campaign->update(['status' => 'FAILED']);
        })->dispatch();
    }
}
