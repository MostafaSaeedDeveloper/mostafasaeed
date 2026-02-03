<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\PaymentRequest;
use App\Models\Account;
use App\Models\Currency;
use App\Models\Customer;
use App\Models\Payment;
use App\Models\Invoice;

class PaymentController extends Controller
{
    public function index()
    {
        return view('admin.payments.index', [
            'payments' => Payment::query()->latest()->get(),
        ]);
    }

    public function create()
    {
        return view('admin.payments.create', [
            'customers' => Customer::query()->orderBy('name')->get(),
            'invoices' => Invoice::query()->latest()->get(),
            'currencies' => Currency::query()->orderBy('code')->get(),
            'accounts' => Account::query()->orderBy('name')->get(),
        ]);
    }

    public function store(PaymentRequest $request)
    {
        Payment::create($request->validated());

        return redirect()->route('admin.payments.index')->with('status', __('messages.saved'));
    }

    public function edit(Payment $payment)
    {
        return view('admin.payments.edit', [
            'payment' => $payment,
            'customers' => Customer::query()->orderBy('name')->get(),
            'invoices' => Invoice::query()->latest()->get(),
            'currencies' => Currency::query()->orderBy('code')->get(),
            'accounts' => Account::query()->orderBy('name')->get(),
        ]);
    }

    public function update(PaymentRequest $request, Payment $payment)
    {
        $payment->update($request->validated());

        return redirect()->route('admin.payments.index')->with('status', __('messages.saved'));
    }

    public function destroy(Payment $payment)
    {
        $payment->delete();

        return redirect()->route('admin.payments.index')->with('status', __('messages.deleted'));
    }
}
