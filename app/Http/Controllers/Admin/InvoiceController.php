<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Project;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(Request $request): View
    {
        $invoices = Invoice::with(['customer', 'payments'])
            ->when($request->filled('q'), fn ($query) => $query->where('invoice_number', 'like', '%'.$request->string('q')->toString().'%'))
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->latest()
            ->paginate(20)
            ->withQueryString();

        return view('admin.invoices.index', compact('invoices'));
    }

    public function create(): View
    {
        $setting = Setting::first();

        return view('admin.invoices.create', [
            'customers' => Customer::orderBy('name')->get(),
            'currencies' => Currency::orderBy('code')->get(),
            'projects' => Project::orderBy('created_at', 'desc')->get(),
            'invoice' => new Invoice([
                'issue_date' => now()->toDateString(),
                'due_date' => now()->addDays($setting?->default_due_days ?? 7)->toDateString(),
                'notes' => $setting?->invoice_notes,
                'invoice_prefix' => $setting?->invoice_prefix ?? 'INV-',
            ]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateInvoice($request);

        DB::transaction(function () use ($data, $request): void {
            $setting = Setting::first();
            $start = (int) ($setting?->invoice_start_number ?? 1);
            $nextNumber = max(((int) Invoice::max('invoice_number')) + 1, $start);
            $invoice = Invoice::create(array_merge($data, [
                'invoice_number' => $nextNumber,
                'invoice_prefix' => $data['invoice_prefix'] ?? $setting?->invoice_prefix ?? 'INV-',
            ]));
            $this->syncItems($invoice, $request);
            $this->refreshTotals($invoice);
        });

        return redirect()->route('admin.invoices.index')->with('success', __('app.saved_successfully'));
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load(['customer', 'items', 'payments.paymentMethod', 'project', 'currency']);
        $settings = Setting::first();

        return view('admin.invoices.show', compact('invoice', 'settings'));
    }

    public function edit(Invoice $invoice): View
    {
        $invoice->load('items');

        return view('admin.invoices.edit', [
            'invoice' => $invoice,
            'customers' => Customer::orderBy('name')->get(),
            'currencies' => Currency::orderBy('code')->get(),
            'projects' => Project::orderBy('created_at', 'desc')->get(),
        ]);
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
        $data = $this->validateInvoice($request);

        DB::transaction(function () use ($invoice, $data, $request): void {
            $invoice->update($data);
            $invoice->items()->delete();
            $this->syncItems($invoice, $request);
            $this->refreshTotals($invoice);
        });

        return redirect()->route('admin.invoices.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Invoice $invoice): RedirectResponse
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')->with('success', __('app.deleted_successfully'));
    }

    public function markSent(Invoice $invoice): RedirectResponse
    {
        $invoice->update(['status' => 'sent']);

        return back()->with('success', __('app.saved_successfully'));
    }

    public function duplicate(Invoice $invoice): RedirectResponse
    {
        $clone = null;
        DB::transaction(function () use ($invoice, &$clone): void {
            $newNumber = ((int) Invoice::max('invoice_number')) + 1;
            $clone = $invoice->replicate(['status', 'paid_amount', 'due_amount']);
            $clone->invoice_number = $newNumber;
            $clone->status = 'draft';
            $clone->paid_amount = 0;
            $clone->due_amount = $invoice->total;
            $clone->push();

            foreach ($invoice->items as $item) {
                $copy = $item->replicate();
                $copy->invoice_id = $clone->id;
                $copy->save();
            }
        });

        return redirect()->route('admin.invoices.edit', $clone)->with('success', __('app.saved_successfully'));
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load(['customer', 'items', 'payments', 'project']);
        $settings = Setting::first();

        $pdf = Pdf::loadView('admin.invoices.pdf', compact('invoice', 'settings'));
        $fileName = sprintf('%s%06d-%s.pdf', $invoice->invoice_prefix ?? 'INV-', $invoice->invoice_number, str($invoice->customer?->name ?? 'client')->slug());

        return $pdf->download($fileName);
    }

    private function validateInvoice(Request $request): array
    {
        return $request->validate([
            'customer_id' => ['required', 'exists:customers,id'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'issue_date' => ['required', 'date'],
            'due_date' => ['nullable', 'date'],
            'currency_id' => ['nullable', 'exists:currencies,id'],
            'exchange_rate_to_base' => ['nullable', 'numeric', 'min:0.000001'],
            'status' => ['required', 'in:draft,sent,paid,partially_paid,overdue,cancelled'],
            'notes' => ['nullable', 'string'],
            'invoice_prefix' => ['nullable', 'string', 'max:15'],
            'discount' => ['nullable', 'numeric', 'min:0'],
            'tax' => ['nullable', 'numeric', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.name' => ['required', 'string', 'max:255'],
            'items.*.qty' => ['required', 'numeric', 'min:0.1'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
            'items.*.line_discount' => ['nullable', 'numeric', 'min:0'],
        ]);
    }

    private function syncItems(Invoice $invoice, Request $request): void
    {
        foreach ($request->input('items', []) as $item) {
            $lineTotal = ($item['qty'] * $item['unit_price']) - ($item['line_discount'] ?? 0);
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'name' => $item['name'],
                'qty' => $item['qty'],
                'unit_price' => $item['unit_price'],
                'line_discount' => $item['line_discount'] ?? 0,
                'line_total' => $lineTotal,
            ]);
        }
    }

    private function refreshTotals(Invoice $invoice): void
    {
        $subtotal = (float) $invoice->items()->sum('line_total');
        $discount = (float) ($invoice->discount ?? 0);
        $tax = (float) ($invoice->tax ?? 0);
        $total = $subtotal - $discount + $tax;
        $paidAmount = (float) $invoice->payments()->sum('amount');

        $invoice->update([
            'subtotal' => $subtotal,
            'total' => $total,
            'paid_amount' => $paidAmount,
            'due_amount' => max($total - $paidAmount, 0),
        ]);
    }
}
