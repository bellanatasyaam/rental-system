<?php

namespace App\Console;

use App\Models\Contract;
use App\Mail\ContractReminderMail;
use Illuminate\Support\Facades\Mail;
use Illuminate\Console\Scheduling\Schedule;
use Illuminate\Foundation\Console\Kernel as ConsoleKernel;

class Kernel extends ConsoleKernel
{
    /**
     * Define the application's command schedule.
     */
    protected function schedule(Schedule $schedule): void
    {
        $schedule->call(function () {
            $today = \Carbon\Carbon::now();
            $targetDate = $today->copy()->addWeek();

            // Cari kontrak yang 1 minggu lagi jatuh tempo
            $contracts = Contract::whereDate('end_date', $targetDate->toDateString())->get();

            foreach ($contracts as $contract) {
                $tenant = $contract->tenant;
                if ($tenant && $tenant->email) {
                    Mail::to($tenant->email)
                        ->send(new ContractReminderMail($tenant, $contract));
                }
            }
        })->dailyAt('08:00'); // cek tiap hari jam 8 pagi
    }

    /**
     * Register the commands for the application.
     */
    protected function commands(): void
    {
        $this->load(__DIR__.'/Commands');

        require base_path('routes/console.php');
    }
}
