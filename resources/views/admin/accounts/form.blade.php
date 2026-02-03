<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.name') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="name" value="{{ old('name', $account?->name) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.type') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="type" value="{{ old('type', $account?->type) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.currency') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="currency_id">
            <option value="">{{ __('messages.select') }}</option>
            @foreach($currencies as $currency)
                <option value="{{ $currency->id }}" @selected(old('currency_id', $account?->currency_id) == $currency->id)>{{ $currency->code }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.opening_balance') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="opening_balance" value="{{ old('opening_balance', $account?->opening_balance) }}">
    </div>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
