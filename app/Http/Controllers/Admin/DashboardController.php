<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Revenue;
use App\Services\ReportService;

class DashboardController extends Controller
{
    public function __invoke(ReportService $reportService)
    {
        $monthlyRevenue = Revenue::query()->whereMonth('received_at', now()->month)->sum('amount');
        $monthlyExpenses = Expense::query()->whereMonth('spent_at', now()->month)->sum('amount');
        $unpaidInvoices = Invoice::query()->whereIn('status', ['sent', 'overdue'])->count();
        $totalDue = Invoice::query()->whereIn('status', ['sent', 'overdue'])->sum('total');

        return view('admin.dashboard', [
            'monthlyRevenue' => $monthlyRevenue,
            'monthlyExpenses' => $monthlyExpenses,
            'netProfit' => $monthlyRevenue - $monthlyExpenses,
            'unpaidInvoices' => $unpaidInvoices,
            'totalDue' => $totalDue,
            'profitAndLoss' => $reportService->profitAndLoss(),
            'recentPayments' => Payment::query()->latest()->take(5)->get(),
        ]);
    }
}
