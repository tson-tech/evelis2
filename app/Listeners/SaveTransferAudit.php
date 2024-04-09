<?php

namespace App\Listeners;

use App\Models\TransferAudit;
use App\Events\TransferExecuted;
use Illuminate\Queue\InteractsWithQueue;
use Illuminate\Contracts\Queue\ShouldQueue;

class SaveTransferAudit
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
        TransferAudit::create([
            'customer_id' => $ledger->customer_id,
            'ip_address' => request()->ip(),
            'location' => request()->header('X-Location'),
            'amount' => $ledger->amount
        ]);
    }
}
