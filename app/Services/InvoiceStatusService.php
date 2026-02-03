<?php

namespace App\Services;

use App\Models\Invoice;
use Carbon\Carbon;

class InvoiceStatusService
{
    public function refreshStatus(Invoice $invoice): void
    {
        if ($invoice->status === 'paid' || $invoice->status === 'cancelled') {
            return;
        }

        if (Carbon::now()->startOfDay()->greaterThan($invoice->due_date)) {
            $invoice->update(['status' => 'overdue']);
        }
    }
}
