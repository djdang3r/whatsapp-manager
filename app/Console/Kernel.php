<?php

namespace App\Console;

use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define los comandos programados de la aplicación.
     */
    protected function schedule(Schedule $schedule): void
    {
        // Aquí registrarás tus comandos programados
        $schedule->command('campaigns:check')->everyMinute();
    }

    /**
     * Registrar los comandos de la aplicación.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');
        require base_path('routes/console.php');
    }
}
