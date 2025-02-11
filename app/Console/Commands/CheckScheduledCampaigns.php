<?php

namespace App\Console\Commands;

use App\Models\Campaign;
use Illuminate\Console\Command;

class CheckScheduledCampaigns extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'campaigns:check';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Verifica campañas programadas para ejecutar';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        Campaign::where('status', 'SCHEDULED')
            ->where('scheduled_at', '<=', now())
            ->each(function ($campaign) {
                // Lógica para procesar la campaña
                $this->info("Campaña iniciada: {$campaign->name}");
            });
    }
}
