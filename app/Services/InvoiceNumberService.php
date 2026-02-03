<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceNumberService
{
    public function nextNumber(): string
    {
        $latest = Invoice::query()->latest('id')->value('number');
        if (! $latest) {
            return 'INV-0001';
        }

        $number = (int) preg_replace('/\D/', '', $latest);
        $next = $number + 1;

        return 'INV-' . str_pad((string) $next, 4, '0', STR_PAD_LEFT);
    }
}
