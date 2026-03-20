<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Expense;
use App\Models\Invoice;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $now = now();
        $monthlyRevenue = Invoice::where('status', 'paid')
            ->whereYear('issue_date', $now->year)
            ->whereMonth('issue_date', $now->month)
            ->sum('total');

        $monthlyExpenses = Expense::whereYear(DB::raw('COALESCE(expense_date, date)'), $now->year)
            ->whereMonth(DB::raw('COALESCE(expense_date, date)'), $now->month)
            ->sum('amount');

        $unpaidQuery = Invoice::whereIn('status', ['draft', 'sent', 'overdue']);
        $unpaidInvoices = $unpaidQuery->count();
        $totalDue = (clone $unpaidQuery)->sum('total');

        $months = collect(range(1, 12))->map(fn (int $month) => Carbon::create()->month($month)->format('M'));
        $revenueSeries = collect(range(1, 12))->map(fn (int $month) => (float) Invoice::where('status', 'paid')
            ->whereYear('issue_date', $now->year)
            ->whereMonth('issue_date', $month)
            ->sum('total'));
        $expenseSeries = collect(range(1, 12))->map(fn (int $month) => (float) Expense::whereYear(DB::raw('COALESCE(expense_date, date)'), $now->year)
            ->whereMonth(DB::raw('COALESCE(expense_date, date)'), $month)
            ->sum('amount'));

        $activities = Activity::orderByDesc('created_at')->limit(10)->get();

        return view('admin.dashboard', [
            'monthlyRevenue' => $monthlyRevenue,
            'monthlyExpenses' => $monthlyExpenses,
            'netProfit' => $monthlyRevenue - $monthlyExpenses,
            'unpaidInvoices' => $unpaidInvoices,
            'totalDue' => $totalDue,
            'activities' => $activities,
            'chartLabels' => $months,
            'chartRevenue' => $revenueSeries,
            'chartExpenses' => $expenseSeries,
        ]);
    }
}
