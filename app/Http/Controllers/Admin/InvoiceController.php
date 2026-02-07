<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Project;
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
        return view('admin.invoices.create', [
            'customers' => Customer::orderBy('name')->get(),
            'currencies' => Currency::orderBy('code')->get(),
            'projects' => Project::orderBy('created_at', 'desc')->get(),
            'invoice' => new Invoice(['issue_date' => now()->toDateString()]),
        ]);
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateInvoice($request);

        DB::transaction(function () use ($data, $request): void {
            $invoice = Invoice::create(array_merge($data, ['invoice_number' => ((int) Invoice::max('invoice_number')) + 1]));
            $this->syncItems($invoice, $request);
            $this->refreshTotals($invoice);
        });

        return redirect()->route('admin.invoices.index')->with('success', __('app.saved_successfully'));
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load(['customer', 'items', 'payments', 'project']);

        return view('admin.invoices.show', compact('invoice'));
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

        $invoice->update([
            'subtotal' => $subtotal,
            'total' => $total,
        ]);
    }
}
