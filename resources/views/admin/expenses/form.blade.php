<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.date') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="spent_at" type="date" value="{{ old('spent_at', optional($expense?->spent_at)->format('Y-m-d')) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.category') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="category_id">
            <option value="">{{ __('messages.select') }}</option>
            @foreach($categories as $category)
                <option value="{{ $category->id }}" @selected(old('category_id', $expense?->category_id) == $category->id)>{{ $category->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.amount') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="amount" value="{{ old('amount', $expense?->amount) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.currency') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="currency_id">
            @foreach($currencies as $currency)
                <option value="{{ $currency->id }}" @selected(old('currency_id', $expense?->currency_id) == $currency->id)>{{ $currency->code }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.exchange_rate') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="exchange_rate" value="{{ old('exchange_rate', $expense?->exchange_rate ?? 1) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.account') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="account_id">
            <option value="">{{ __('messages.select') }}</option>
            @foreach($accounts as $account)
                <option value="{{ $account->id }}" @selected(old('account_id', $expense?->account_id) == $account->id)>{{ $account->name }}</option>
            @endforeach
        </select>
    </div>
</div>
<div class="mt-4">
    <label class="text-sm">{{ __('messages.notes') }}</label>
    <textarea class="mt-1 w-full rounded border px-3 py-2" name="notes" rows="3">{{ old('notes', $expense?->notes) }}</textarea>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
