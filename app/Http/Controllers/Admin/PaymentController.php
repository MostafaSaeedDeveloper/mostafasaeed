<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(): View
    {
        $payments = Payment::with('invoice.client')->latest('payment_date')->paginate(10);

        return view('admin.payments.index', compact('payments'));
    }

    public function create(): View
    {
        return view('admin.payments.create', [
            'payment' => new Payment(['payment_date' => now()->toDateString()]),
            'invoices' => Invoice::with('client')->orderByDesc('issue_date')->get(),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validated($request);
        $invoice = Invoice::findOrFail($data['invoice_id']);
        $payment = Payment::create(array_merge($data, [
            'customer_id' => null,
            'date' => $data['payment_date'],
            'payment_method' => $data['method'],
        ]));
        $this->syncInvoiceStatus($invoice);
        Activity::create(['type' => 'payment', 'description' => "Payment received for {$invoice->formatted_number}", 'created_at' => now()]);

        return redirect()->route('admin.payments.index')->with('success', __('app.saved_successfully'));
    }

    public function edit(Payment $payment): View
    {
        return view('admin.payments.edit', ['payment' => $payment, 'invoices' => Invoice::with('client')->orderByDesc('issue_date')->get()]);
    }

    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $payment->update(array_merge($this->validated($request), ['date' => $request->input('payment_date'), 'payment_method' => $request->input('method')]));
        $this->syncInvoiceStatus($payment->invoice);

        return redirect()->route('admin.payments.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Payment $payment): RedirectResponse
    {
        $invoice = $payment->invoice;
        $payment->delete();
        $this->syncInvoiceStatus($invoice);

        return redirect()->route('admin.payments.index')->with('success', __('app.deleted_successfully'));
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'invoice_id' => ['required', 'exists:invoices,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'payment_date' => ['required', 'date'],
            'method' => ['required', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);
    }

    private function syncInvoiceStatus(?Invoice $invoice): void
    {
        if (! $invoice) {
            return;
        }

        $paidAmount = (float) $invoice->payments()->sum('amount');
        $status = $paidAmount >= (float) $invoice->total ? 'paid' : ($invoice->due_date && now()->gt($invoice->due_date) ? 'overdue' : 'sent');
        $invoice->update([
            'status' => $status,
            'paid_amount' => $paidAmount,
            'due_amount' => max(((float) $invoice->total) - $paidAmount, 0),
        ]);
    }
}
