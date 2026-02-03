<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.customer') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="customer_id">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $payment?->customer_id) == $customer->id)>{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.invoice') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="invoice_id">
            <option value="">{{ __('messages.select') }}</option>
            @foreach($invoices as $invoice)
                <option value="{{ $invoice->id }}" @selected(old('invoice_id', $payment?->invoice_id) == $invoice->id)>{{ $invoice->number }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.amount') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="amount" value="{{ old('amount', $payment?->amount) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.currency') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="currency_id">
            @foreach($currencies as $currency)
                <option value="{{ $currency->id }}" @selected(old('currency_id', $payment?->currency_id) == $currency->id)>{{ $currency->code }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.exchange_rate') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="exchange_rate" value="{{ old('exchange_rate', $payment?->exchange_rate ?? 1) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.payment_method') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="payment_method" value="{{ old('payment_method', $payment?->payment_method) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.account') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="account_id">
            <option value="">{{ __('messages.select') }}</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}" @selected(old('account_id', $payment?->account_id) == $account->id)>{{ $account->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.date') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="paid_at" type="date" value="{{ old('paid_at', optional($payment?->paid_at)->format('Y-m-d')) }}">
    </div>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
