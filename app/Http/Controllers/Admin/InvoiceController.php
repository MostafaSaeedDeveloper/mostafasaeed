<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\InvoiceRequest;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Invoice;
use App\Services\InvoiceNumberService;
use App\Services\InvoiceStatusService;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Support\Facades\DB;

class InvoiceController extends Controller
{
    public function index()
    {
        return view('admin.invoices.index', [
            'invoices' => Invoice::query()->latest()->get(),
        ]);
    }

    public function create(InvoiceNumberService $numberService)
    {
        return view('admin.invoices.create', [
            'customers' => Customer::query()->orderBy('name')->get(),
            'currencies' => Currency::query()->orderBy('code')->get(),
            'nextNumber' => $numberService->nextNumber(),
        ]);
    }

    public function store(InvoiceRequest $request, InvoiceNumberService $numberService)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $numberService): void {
            $invoice = Invoice::create([
                'number' => $numberService->nextNumber(),
                'customer_id' => $data['customer_id'],
                'issue_date' => $data['issue_date'],
                'due_date' => $data['due_date'],
                'currency_id' => $data['currency_id'],
                'exchange_rate' => $data['exchange_rate'],
                'status' => $data['status'],
                'discount' => $data['discount'] ?? 0,
                'tax' => $data['tax'] ?? 0,
                'notes' => $data['notes'] ?? null,
            ]);

            $subtotal = 0;

            foreach ($data['items'] as $item) {
                $lineTotal = ($item['quantity'] * $item['unit_price']) - ($item['line_discount'] ?? 0);
                $invoice->items()->create([
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'line_discount' => $item['line_discount'] ?? 0,
                    'line_total' => $lineTotal,
                ]);
                $subtotal += $lineTotal;
            }

            $total = $subtotal - ($data['discount'] ?? 0) + ($data['tax'] ?? 0);

            $invoice->update([
                'subtotal' => $subtotal,
                'total' => $total,
            ]);
        });

        return redirect()->route('admin.invoices.index')->with('status', __('messages.saved'));
    }

    public function show(Invoice $invoice, InvoiceStatusService $statusService)
    {
        $statusService->refreshStatus($invoice);

        return view('admin.invoices.show', [
            'invoice' => $invoice->load('items', 'customer', 'currency'),
        ]);
    }

    public function edit(Invoice $invoice)
    {
        return view('admin.invoices.edit', [
            'invoice' => $invoice->load('items'),
            'customers' => Customer::query()->orderBy('name')->get(),
            'currencies' => Currency::query()->orderBy('code')->get(),
        ]);
    }

    public function update(InvoiceRequest $request, Invoice $invoice)
    {
        $data = $request->validated();

        DB::transaction(function () use ($data, $invoice): void {
            $invoice->update([
                'customer_id' => $data['customer_id'],
                'issue_date' => $data['issue_date'],
                'due_date' => $data['due_date'],
                'currency_id' => $data['currency_id'],
                'exchange_rate' => $data['exchange_rate'],
                'status' => $data['status'],
                'discount' => $data['discount'] ?? 0,
                'tax' => $data['tax'] ?? 0,
                'notes' => $data['notes'] ?? null,
            ]);

            $invoice->items()->delete();
            $subtotal = 0;

            foreach ($data['items'] as $item) {
                $lineTotal = ($item['quantity'] * $item['unit_price']) - ($item['line_discount'] ?? 0);
                $invoice->items()->create([
                    'name' => $item['name'],
                    'quantity' => $item['quantity'],
                    'unit_price' => $item['unit_price'],
                    'line_discount' => $item['line_discount'] ?? 0,
                    'line_total' => $lineTotal,
                ]);
                $subtotal += $lineTotal;
            }

            $total = $subtotal - ($data['discount'] ?? 0) + ($data['tax'] ?? 0);

            $invoice->update([
                'subtotal' => $subtotal,
                'total' => $total,
            ]);
        });

        return redirect()->route('admin.invoices.index')->with('status', __('messages.saved'));
    }

    public function destroy(Invoice $invoice)
    {
        $invoice->delete();

        return redirect()->route('admin.invoices.index')->with('status', __('messages.deleted'));
    }

    public function pdf(Invoice $invoice)
    {
        $invoice->load('items', 'customer', 'currency');

        $pdf = Pdf::loadView('admin.invoices.pdf', [
            'invoice' => $invoice,
        ]);

        return $pdf->download($invoice->number . '.pdf');
    }
}
