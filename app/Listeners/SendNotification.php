<?php

namespace App\Listeners;

use App\Models\Notification;
use App\Events\TransferExecuted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SendNotification
{
    /**
     * Create the event listener.
     */
    public function __construct()
    {
        //
    }

    /**
     * Handle the event.
     */
    public function handle(TransferExecuted $event): void
    {
        $ledger = $event->getLedger();
        Notification::create([
            'customer_id' => $ledger->customer_id,
            'title' => 'TRANSFER SUCCESS',
            'body' => 'Your Transfer from'.$ledger->src_account.' To '.$ledger->dst_account,
        ]);
    }
}
