<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Invoice;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(): View
    {
        $year = now()->year;
        $rows = collect(range(1, 12))->map(function (int $month) use ($year) {
            $revenue = (float) Invoice::where('status', 'paid')->whereYear('issue_date', $year)->whereMonth('issue_date', $month)->sum('total');
            $expenses = (float) Expense::whereYear(DB::raw('COALESCE(expense_date, date)'), $year)->whereMonth(DB::raw('COALESCE(expense_date, date)'), $month)->sum('amount');
            return [
                'label' => now()->startOfYear()->month($month)->format('F'),
                'revenue' => $revenue,
                'expenses' => $expenses,
                'net' => $revenue - $expenses,
            ];
        });

        $topClients = Invoice::query()
            ->selectRaw('clients.name, SUM(invoices.total) as revenue')
            ->join('clients', 'clients.id', '=', 'invoices.client_id')
            ->where('invoices.status', 'paid')
            ->groupBy('clients.name')
            ->orderByDesc('revenue')
            ->limit(5)
            ->get();

        return view('admin.reports.index', [
            'rows' => $rows,
            'topClients' => $topClients,
        ]);
    }
}
