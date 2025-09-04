<?php

namespace App\Console\Commands;

use Illuminate\Console\Command;
use App\Models\Contract;
use App\Mail\contractReminderMail;
use Illuminate\Support\Facades\Mail;
use Carbon\Carbon;

class SendContractReminder extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'app:send-contract-reminder';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Execute the console command.
     */
    public function handle()
    {
        $contracts = Contract::whereDate('end_date', Carbon::now()->addWeek()->toDateString())->get();

        foreach ($contracts as $contract) {
            Mail::to($contract->tenant->email)->send(new ContractReminderMail($contract));
        }
    }
}
