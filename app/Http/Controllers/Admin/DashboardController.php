<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Expense;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Support\Collection;
use Illuminate\View\View;

class DashboardController extends Controller
{
    public function index(): View
    {
        $monthlyRevenue = Payment::whereMonth('date', now()->month)->sum('amount');
        $monthlyExpenses = Expense::whereMonth('date', now()->month)->sum('amount');
        $netProfit = $monthlyRevenue - $monthlyExpenses;
        $unpaidInvoices = Invoice::whereIn('status', ['sent', 'partially_paid', 'overdue'])->count();
        $totalDue = Invoice::whereIn('status', ['sent', 'partially_paid', 'overdue'])->sum('total');

        $activities = Collection::make()
            ->merge(Invoice::latest()->limit(4)->get()->map(fn ($invoice) => [
                'date' => $invoice->created_at,
                'label' => "Invoice #{$invoice->invoice_number} created",
            ]))
            ->merge(Payment::latest()->limit(4)->get()->map(fn ($payment) => [
                'date' => $payment->created_at,
                'label' => 'Payment received: '.number_format((float) $payment->amount, 2),
            ]))
            ->merge(Expense::latest()->limit(4)->get()->map(fn ($expense) => [
                'date' => $expense->created_at,
                'label' => 'Expense added: '.number_format((float) $expense->amount, 2),
            ]))
            ->sortByDesc('date')
            ->take(8)
            ->values();

        return view('admin.dashboard', compact('monthlyRevenue', 'monthlyExpenses', 'netProfit', 'unpaidInvoices', 'totalDue', 'activities'));
    }
}
