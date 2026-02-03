<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use App\Models\Revenue;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $monthlyRevenue = Revenue::whereMonth('date', now()->month)->sum('amount');
        $monthlyExpenses = Expense::whereMonth('date', now()->month)->sum('amount');
        $netProfit = $monthlyRevenue - $monthlyExpenses;
        $unpaidInvoices = Invoice::where('status', '!=', 'paid')->count();
        $totalDue = Invoice::where('status', '!=', 'paid')->sum('total');
        $recentPayments = Payment::latest()->limit(5)->get();

        return view('admin.dashboard', compact(
            'monthlyRevenue',
            'monthlyExpenses',
            'netProfit',
            'unpaidInvoices',
            'totalDue',
            'recentPayments'
        ));
    }
}
