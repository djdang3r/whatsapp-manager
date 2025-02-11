<?php

use Illuminate\Foundation\Inspiring;
use Illuminate\Support\Facades\Artisan;
use App\Console\Commands\CheckScheduledCampaigns;
use Illuminate\Foundation\Console\ClosureCommand;

Artisan::command('inspire', function () {
    $this->comment(Inspiring::quote());
})->purpose('Display an inspiring quote');

// Registrar comando
// Solo programar la ejecución, no registrar el comando aquí
Schedule::command('campaigns:check')->everyMinute();
