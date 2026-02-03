<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.customer') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="customer_id">
            @foreach($customers as $customer)
                <option value="{{ $customer->id }}" @selected(old('customer_id', $invoice?->customer_id) == $customer->id)>{{ $customer->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.currency') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="currency_id">
            @foreach($currencies as $currency)
                <option value="{{ $currency->id }}" @selected(old('currency_id', $invoice?->currency_id) == $currency->id)>{{ $currency->code }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.issue_date') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="issue_date" type="date" value="{{ old('issue_date', optional($invoice?->issue_date)->format('Y-m-d')) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.due_date') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="due_date" type="date" value="{{ old('due_date', optional($invoice?->due_date)->format('Y-m-d')) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.exchange_rate') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="exchange_rate" value="{{ old('exchange_rate', $invoice?->exchange_rate ?? 1) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.status') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="status" value="{{ old('status', $invoice?->status ?? 'draft') }}">
    </div>
</div>
<div class="mt-4">
    <h3 class="text-sm font-semibold">{{ __('messages.items') }}</h3>
    <div class="mt-2 grid gap-2 md:grid-cols-4">
        <input class="rounded border px-3 py-2" name="items[0][name]" placeholder="{{ __('messages.item_name') }}" value="{{ old('items.0.name', $invoice?->items[0]?->name) }}">
        <input class="rounded border px-3 py-2" name="items[0][quantity]" placeholder="{{ __('messages.quantity') }}" value="{{ old('items.0.quantity', $invoice?->items[0]?->quantity ?? 1) }}">
        <input class="rounded border px-3 py-2" name="items[0][unit_price]" placeholder="{{ __('messages.unit_price') }}" value="{{ old('items.0.unit_price', $invoice?->items[0]?->unit_price ?? 0) }}">
        <input class="rounded border px-3 py-2" name="items[0][line_discount]" placeholder="{{ __('messages.discount') }}" value="{{ old('items.0.line_discount', $invoice?->items[0]?->line_discount ?? 0) }}">
    </div>
</div>
<div class="mt-4 grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.discount') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="discount" value="{{ old('discount', $invoice?->discount ?? 0) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.tax') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="tax" value="{{ old('tax', $invoice?->tax ?? 0) }}">
    </div>
</div>
<div class="mt-4">
    <label class="text-sm">{{ __('messages.notes') }}</label>
    <textarea class="mt-1 w-full rounded border px-3 py-2" name="notes" rows="3">{{ old('notes', $invoice?->notes) }}</textarea>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
