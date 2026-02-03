<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Revenue;
use Illuminate\Support\Collection;

class ReportService
{
    public function profitAndLoss(): Collection
    {
        $income = Revenue::query()->sum('amount');
        $payments = Payment::query()->sum('amount');
        $expenses = Expense::query()->sum('amount');

        return collect([
            'income' => $income,
            'payments' => $payments,
            'expenses' => $expenses,
            'net' => $income + $payments - $expenses,
        ]);
    }

    public function invoiceAging(): Collection
    {
        $today = now()->startOfDay();

        $overdue = Invoice::query()->where('status', 'overdue')->count();
        $dueSoon = Invoice::query()->where('status', 'sent')->whereDate('due_date', '<=', $today->copy()->addDays(7))->count();

        return collect([
            'overdue' => $overdue,
            'due_soon' => $dueSoon,
        ]);
    }
}
