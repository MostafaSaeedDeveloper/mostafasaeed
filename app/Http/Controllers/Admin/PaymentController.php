<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\Payment;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class PaymentController extends Controller
{
    public function index(Request $request): View
    {
        $payments = Payment::with(['customer', 'invoice'])
            ->when($request->filled('customer_id'), fn ($query) => $query->where('customer_id', $request->integer('customer_id')))
            ->when($request->filled('payment_method'), fn ($query) => $query->where('payment_method', $request->string('payment_method')->toString()))
            ->when($request->filled('from'), fn ($query) => $query->whereDate('date', '>=', $request->date('from')))
            ->when($request->filled('to'), fn ($query) => $query->whereDate('date', '<=', $request->date('to')))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        $customers = Customer::orderBy('name')->get();

        return view('admin.payments.index', compact('payments', 'customers'));
    }

    public function create(): View
    {
        return view('admin.payments.create', $this->formData(new Payment(['date' => now()->toDateString()])));
    }

    public function store(Request $request): RedirectResponse
    {
        $payment = Payment::create($this->validated($request));
        $this->syncInvoiceStatus($payment->invoice);

        return redirect()->route('admin.payments.index')->with('success', __('app.saved_successfully'));
    }

    public function edit(Payment $payment): View
    {
        return view('admin.payments.edit', $this->formData($payment));
    }

    public function update(Request $request, Payment $payment): RedirectResponse
    {
        $previousInvoice = $payment->invoice;
        $payment->update($this->validated($request));

        $this->syncInvoiceStatus($previousInvoice);
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

    private function formData(Payment $payment): array
    {
        return [
            'payment' => $payment,
            'customers' => Customer::orderBy('name')->get(),
            'invoices' => Invoice::orderByDesc('invoice_number')->get(),
            'currencies' => Currency::orderBy('code')->get(),
            'accounts' => Account::orderBy('name')->get(),
        ];
    }

    private function validated(Request $request): array
    {
        return $request->validate([
            'customer_id' => ['nullable', 'exists:customers,id'],
            'invoice_id' => ['nullable', 'exists:invoices,id'],
            'amount' => ['required', 'numeric', 'min:0.01'],
            'currency_id' => ['nullable', 'exists:currencies,id'],
            'exchange_rate_to_base' => ['nullable', 'numeric', 'min:0.000001'],
            'payment_method' => ['required', 'in:cash,vodafone_cash,bank_transfer,paypal,stripe,other'],
            'account_id' => ['nullable', 'exists:accounts,id'],
            'date' => ['required', 'date'],
            'reference' => ['nullable', 'string', 'max:255'],
            'notes' => ['nullable', 'string'],
        ]);
    }

    private function syncInvoiceStatus(?Invoice $invoice): void
    {
        if (! $invoice) {
            return;
        }

        $paidAmount = (float) $invoice->payments()->sum('amount');
        if ($paidAmount <= 0) {
            $invoice->update(['status' => ($invoice->due_date && now()->gt($invoice->due_date)) ? 'overdue' : 'sent']);
            return;
        }

        if ($paidAmount >= (float) $invoice->total) {
            $invoice->update(['status' => 'paid']);
            return;
        }

        $invoice->update(['status' => 'partially_paid']);
    }
}
