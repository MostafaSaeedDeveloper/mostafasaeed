<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Activity;
use App\Models\Client;
use App\Models\Customer;
use App\Models\Invoice;
use App\Models\InvoiceItem;
use App\Models\Project;
use App\Models\Setting;
use Barryvdh\DomPDF\Facade\Pdf;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\View\View;

class InvoiceController extends Controller
{
    public function index(Request $request): View
    {
        $query = Invoice::with(['client', 'project', 'payments'])
            ->when($request->filled('q'), function ($query) use ($request) {
                $search = $request->string('q')->toString();
                $numericSearch = preg_replace('/\D+/', '', $search);
                $query->where(function ($q) use ($search, $numericSearch): void {
                    $q->where('invoice_number', 'like', "%{$search}%");
                    if ($numericSearch !== '') {
                        $q->orWhere('invoice_number', 'like', "%{$numericSearch}%");
                    }
                    $q->orWhereHas('client', fn ($clientQuery) => $clientQuery->where('name', 'like', "%{$search}%"));
                });
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')));

        $totals = [
            'grand_total' => (clone $query)->sum('total'),
            'paid_total' => (clone $query)->sum('paid_amount'),
            'due_total' => (clone $query)->sum('due_amount'),
        ];

        $invoices = $query->latest()->paginate(10)->withQueryString();

        return view('admin.invoices.index', compact('invoices', 'totals'));
    }

    public function create(): View
    {
        return view('admin.invoices.create', $this->formData(new Invoice([
            'issue_date' => now()->toDateString(),
            'due_date' => now()->addDays(7)->toDateString(),
            'status' => 'draft',
            'currency' => 'EGP',
            'tax_percent' => Setting::first()?->default_tax_rate ?? 0,
            'invoice_number' => $this->generateInvoiceNumber(),
        ])));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validateInvoice($request);

        DB::transaction(function () use ($data, $request): void {
            $invoice = Invoice::create(array_merge($data, [
                'invoice_number' => $this->generateInvoiceNumber(),
                'customer_id' => $this->resolveCustomerId((int) $data['client_id']),
            ]));
            $this->syncItems($invoice, $request);
            $this->refreshTotals($invoice);
            Activity::create(['type' => 'invoice', 'description' => "Invoice created: {$invoice->formatted_number}", 'created_at' => now()]);
        });

        return redirect()->route('admin.invoices.index')->with('success', __('app.saved_successfully'));
    }

    public function show(Invoice $invoice): View
    {
        $invoice->load(['client', 'project', 'items', 'payments']);

        return view('admin.invoices.show', ['invoice' => $invoice, 'settings' => Setting::first()]);
    }

    public function edit(Invoice $invoice): View
    {
        $invoice->load('items');

        return view('admin.invoices.edit', $this->formData($invoice));
    }

    public function update(Request $request, Invoice $invoice): RedirectResponse
    {
        $data = $this->validateInvoice($request);

        DB::transaction(function () use ($invoice, $data, $request): void {
            $invoice->update(array_merge($data, [
                'customer_id' => $this->resolveCustomerId((int) $data['client_id']),
            ]));
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

    public function markPaid(Invoice $invoice): RedirectResponse
    {
        $invoice->update(['status' => 'paid', 'paid_amount' => $invoice->total, 'due_amount' => 0]);
        return back()->with('success', __('app.saved_successfully'));
    }

    public function markOverdue(Invoice $invoice): RedirectResponse
    {
        $invoice->update(['status' => 'overdue']);
        return back()->with('success', __('app.saved_successfully'));
    }

    public function duplicate(Invoice $invoice): RedirectResponse
    {
        $clone = DB::transaction(function () use ($invoice) {
            $clone = $invoice->replicate(['status', 'paid_amount', 'due_amount', 'invoice_number']);
            $clone->invoice_number = $this->generateInvoiceNumber();
            $clone->customer_id = $this->resolveCustomerId((int) $clone->client_id);
            $clone->status = 'draft';
            $clone->paid_amount = 0;
            $clone->due_amount = $invoice->total;
            $clone->save();
            foreach ($invoice->items as $item) {
                $copy = $item->replicate();
                $copy->invoice_id = $clone->id;
                $copy->save();
            }
            return $clone;
        });

        return redirect()->route('admin.invoices.edit', $clone)->with('success', __('app.saved_successfully'));
    }

    public function downloadPdf(Invoice $invoice)
    {
        $invoice->load(['client', 'project', 'items', 'payments']);
        return Pdf::loadView('admin.invoices.pdf', ['invoice' => $invoice, 'settings' => Setting::first()])
            ->download($invoice->formatted_number.'.pdf');
    }

    public function projectsByClient(Client $client): JsonResponse
    {
        return response()->json($client->projects()->select('id', 'title')->orderByDesc('created_at')->get());
    }

    private function formData(Invoice $invoice): array
    {
        return [
            'invoice' => $invoice,
            'clients' => Client::orderBy('name')->get(),
            'projects' => Project::orderByDesc('created_at')->get(),
        ];
    }

    private function validateInvoice(Request $request): array
    {
        return $request->validate([
            'client_id' => ['required', 'exists:clients,id'],
            'project_id' => ['nullable', 'exists:projects,id'],
            'issue_date' => ['required', 'date'],
            'due_date' => ['required', 'date'],
            'currency' => ['required', 'string', 'max:10'],
            'status' => ['required', 'in:draft,sent,paid,overdue,cancelled'],
            'notes' => ['nullable', 'string'],
            'tax_percent' => ['nullable', 'numeric', 'min:0'],
            'items' => ['required', 'array', 'min:1'],
            'items.*.description' => ['required', 'string', 'max:255'],
            'items.*.quantity' => ['required', 'numeric', 'min:0.01'],
            'items.*.unit_price' => ['required', 'numeric', 'min:0'],
        ]);
    }

    private function syncItems(Invoice $invoice, Request $request): void
    {
        foreach ($request->input('items', []) as $item) {
            InvoiceItem::create([
                'invoice_id' => $invoice->id,
                'description' => $item['description'],
                'quantity' => $item['quantity'],
                'unit_price' => $item['unit_price'],
                'total' => (float) $item['quantity'] * (float) $item['unit_price'],
            ]);
        }
    }

    private function refreshTotals(Invoice $invoice): void
    {
        $subtotal = (float) $invoice->items()->sum('total');
        $taxPercent = (float) ($invoice->tax_percent ?? 0);
        $taxAmount = $subtotal * $taxPercent / 100;
        $paidAmount = (float) $invoice->payments()->sum('amount');
        $total = $subtotal + $taxAmount;

        $invoice->update([
            'subtotal' => $subtotal,
            'tax_amount' => $taxAmount,
            'tax' => $taxAmount,
            'total' => $total,
            'paid_amount' => $paidAmount,
            'due_amount' => max($total - $paidAmount, 0),
        ]);
    }


    private function resolveCustomerId(int $clientId): int
    {
        $client = Client::findOrFail($clientId);

        return Customer::firstOrCreate(
            ['email' => $client->email ?: 'client-'.$client->id.'@mostafasaeed.test'],
            [
                'name' => $client->name,
                'company_name' => $client->company,
                'phone' => $client->phone,
                'address' => $client->address,
                'country' => $client->country,
                'notes' => $client->notes,
                'status' => 'active',
            ]
        )->id;
    }

    private function generateInvoiceNumber(): int
    {
        $year = (int) now()->format('Y');
        $base = $year * 1000;
        $latest = (int) Invoice::whereBetween('invoice_number', [$base, $base + 999])
            ->max('invoice_number');
        $next = $latest > 0 ? ($latest - $base) + 1 : 1;

        return $base + $next;
    }
}
