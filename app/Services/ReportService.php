<?php

namespace App\Services;

use App\Models\Expense;
use App\Models\Revenue;
use Illuminate\Support\Collection;
use Illuminate\Support\Carbon;

class ReportService
{
    public function profitAndLoss(Carbon $from, Carbon $to): array
    {
        $revenues = Revenue::whereBetween('date', [$from, $to])->get();
        $expenses = Expense::whereBetween('date', [$from, $to])->get();

        $totalRevenue = $revenues->sum(fn (Revenue $revenue) => $revenue->amount * $revenue->exchange_rate_to_base);
        $totalExpenses = $expenses->sum(fn (Expense $expense) => $expense->amount * $expense->exchange_rate_to_base);

        return [
            'total_revenue' => $totalRevenue,
            'total_expenses' => $totalExpenses,
            'net_profit' => $totalRevenue - $totalExpenses,
        ];
    }

    public function cashflowByAccount(Carbon $from, Carbon $to): Collection
    {
        return Expense::whereBetween('date', [$from, $to])
            ->with('account')
            ->get()
            ->groupBy('account_id');
    }
}
