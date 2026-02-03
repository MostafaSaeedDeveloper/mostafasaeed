<?php

namespace App\Services;

use App\Models\Invoice;
use Illuminate\Support\Carbon;

class InvoiceStatusService
{
    public function updateStatus(Invoice $invoice): void
    {
        $paid = $invoice->payments()->sum('amount');
        $balance = $invoice->total - $paid;

        if ($balance <= 0) {
            $invoice->status = 'paid';
        } elseif ($invoice->due_date && Carbon::parse($invoice->due_date)->isPast()) {
            $invoice->status = 'overdue';
        } elseif ($invoice->status === 'draft') {
            $invoice->status = 'sent';
        }

        $invoice->save();
    }
}
