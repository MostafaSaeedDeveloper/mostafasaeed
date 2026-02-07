<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\Request;
use Illuminate\View\View;

class ReportController extends Controller
{
    public function index(Request $request): View
    {
        $from = $request->date('from')?->startOfDay() ?? now()->startOfMonth();
        $to = $request->date('to')?->endOfDay() ?? now()->endOfMonth();

        $revenue = Payment::whereBetween('date', [$from, $to])->sum('amount');
        $expenses = Expense::whereBetween('date', [$from, $to])->sum('amount');
        $unpaidInvoices = Invoice::whereIn('status', ['sent', 'partially_paid', 'overdue'])->count();
        $topClients = Payment::query()
            ->selectRaw('customers.name as customer_name, SUM(payments.amount) as total_amount')
            ->join('customers', 'customers.id', '=', 'payments.customer_id')
            ->whereBetween('payments.date', [$from, $to])
            ->groupBy('customers.name')
            ->orderByDesc('total_amount')
            ->limit(5)
            ->get();

        return view('admin.reports.index', [
            'from' => $from->toDateString(),
            'to' => $to->toDateString(),
            'revenue' => $revenue,
            'expenses' => $expenses,
            'netProfit' => $revenue - $expenses,
            'unpaidInvoices' => $unpaidInvoices,
            'topClients' => $topClients,
        ]);
    }
}
