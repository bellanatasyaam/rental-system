<?php

namespace App\Notifications;

use Illuminate\Bus\Queueable;
use Illuminate\Contracts\Queue\ShouldQueue;
use Illuminate\Notifications\Messages\DatabaseMessage;
use Illuminate\Notifications\Notification;

class ContractExpiringNotification extends Notification
{
    use Queueable;

    protected $contract;

    public function __construct($contract)
    {
        $this->contract = $contract;
    }

    // Kirim notifikasi ke database
    public function via($notifiable)
    {
        return ['database'];
    }

    public function toDatabase($notifiable)
    {
        return [
            'title' => 'Kontrak Segera Berakhir',
            'message' => "Kontrak {$this->contract->tenant->name} akan berakhir pada {$this->contract->end_date}.",
            'contract_id' => $this->contract->id,
            'end_date' => $this->contract->end_date,
        ];
    }
}
