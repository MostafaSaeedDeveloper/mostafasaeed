<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\CustomerRequest;
use App\Models\Currency;
use App\Models\Customer;

class CustomerController extends Controller
{
    public function index()
    {
        return view('admin.customers.index', [
            'customers' => Customer::query()->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.customers.create', [
            'currencies' => Currency::query()->orderBy('code')->get(),
        ]);
    }

    public function store(CustomerRequest $request)
    {
        Customer::create($request->validated());

        return redirect()->route('admin.customers.index')->with('status', __('messages.saved'));
    }

    public function show(Customer $customer)
    {
        return view('admin.customers.show', [
            'customer' => $customer->load('invoices', 'payments', 'notes'),
        ]);
    }

    public function edit(Customer $customer)
    {
        return view('admin.customers.edit', [
            'customer' => $customer,
            'currencies' => Currency::query()->orderBy('code')->get(),
        ]);
    }

    public function update(CustomerRequest $request, Customer $customer)
    {
        $customer->update($request->validated());

        return redirect()->route('admin.customers.index')->with('status', __('messages.saved'));
    }

    public function destroy(Customer $customer)
    {
        $customer->delete();

        return redirect()->route('admin.customers.index')->with('status', __('messages.deleted'));
    }
}
