<?php

namespace App\Services;

use App\Models\Invoice;

class InvoiceNumberService
{
    public function nextNumber(): int
    {
        $latest = Invoice::max('invoice_number');

        return $latest ? $latest + 1 : 1000;
    }
}
