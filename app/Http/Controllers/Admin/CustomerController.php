<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Models\Currency;
use App\Models\Customer;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\View\View;

class CustomerController extends Controller
{
    public function index(Request $request): View
    {
        $sort = in_array($request->string('sort')->toString(), ['name', 'created_at'], true) ? $request->string('sort')->toString() : 'created_at';
        $dir = $request->string('dir')->toString() === 'asc' ? 'asc' : 'desc';

        $customers = Customer::query()
            ->when($request->filled('q'), function ($query) use ($request): void {
                $term = $request->string('q')->toString();
                $query->where(fn ($q) => $q->where('name', 'like', "%{$term}%")
                    ->orWhere('company_name', 'like', "%{$term}%")
                    ->orWhere('email', 'like', "%{$term}%")
                    ->orWhere('phone', 'like', "%{$term}%"));
            })
            ->when($request->filled('status'), fn ($query) => $query->where('status', $request->string('status')->toString()))
            ->orderBy($sort, $dir)
            ->paginate(20)
            ->withQueryString();

        return view('admin.customers.index', compact('customers'));
    }

    public function create(): View
    {
        $currencies = Currency::orderBy('code')->get();

        return view('admin.customers.create', compact('currencies'));
    }

    public function store(Request $request): RedirectResponse
    {
        $data = $this->validatedData($request);
        Customer::create($data);

        return redirect()->route('admin.customers.index')->with('success', __('app.saved_successfully'));
    }

    public function show(Customer $customer): View
    {
        $customer->load(['projects', 'invoices.payments', 'payments']);
        $totalInvoiced = (float) $customer->invoices->sum('total');
        $totalPaid = (float) $customer->payments->sum('amount');

        return view('admin.customers.show', compact('customer', 'totalInvoiced', 'totalPaid'));
    }

    public function edit(Customer $customer): View
    {
        $currencies = Currency::orderBy('code')->get();

        return view('admin.customers.edit', compact('customer', 'currencies'));
    }

    public function update(Request $request, Customer $customer): RedirectResponse
    {
        $customer->update($this->validatedData($request));

        return redirect()->route('admin.customers.index')->with('success', __('app.saved_successfully'));
    }

    public function destroy(Customer $customer): RedirectResponse
    {
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('success', __('app.deleted_successfully'));
    }

    private function validatedData(Request $request): array
    {
        return $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'company_name' => ['nullable', 'string', 'max:255'],
            'phone' => ['nullable', 'string', 'max:255'],
            'email' => ['nullable', 'email', 'max:255'],
            'address' => ['nullable', 'string', 'max:255'],
            'country' => ['nullable', 'string', 'max:255'],
            'tax_number' => ['nullable', 'string', 'max:255'],
            'default_currency_id' => ['nullable', 'exists:currencies,id'],
            'notes' => ['nullable', 'string'],
            'status' => ['required', 'in:lead,active,inactive'],
        ]);
    }
}
