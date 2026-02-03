<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.date') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="received_at" type="date" value="{{ old('received_at', optional($revenue?->received_at)->format('Y-m-d')) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.source') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="source" value="{{ old('source', $revenue?->source) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.amount') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="amount" value="{{ old('amount', $revenue?->amount) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.currency') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="currency_id">
            @foreach($currencies as $currency)
                <option value="{{ $currency->id }}" @selected(old('currency_id', $revenue?->currency_id) == $currency->id)>{{ $currency->code }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.exchange_rate') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="exchange_rate" value="{{ old('exchange_rate', $revenue?->exchange_rate ?? 1) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.account') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="account_id">
            <option value="">{{ __('messages.select') }}</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}" @selected(old('account_id', $revenue?->account_id) == $account->id)>{{ $account->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mt-4">
    <label class="text-sm">{{ __('messages.notes') }}</label>
    <textarea class="mt-1 w-full rounded border px-3 py-2" name="notes" rows="3">{{ old('notes', $revenue?->notes) }}</textarea>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
