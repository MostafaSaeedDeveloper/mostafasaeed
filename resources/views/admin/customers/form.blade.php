<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.name') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="name" value="{{ old('name', $customer?->name) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.company') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="company" value="{{ old('company', $customer?->company) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.email') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="email" value="{{ old('email', $customer?->email) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.phone') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="phone" value="{{ old('phone', $customer?->phone) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.currency') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="currency_id">
            <option value="">{{ __('messages.select') }}</option>
            @foreach($currencies as $currency)
                <option value="{{ $currency->id }}" @selected(old('currency_id', $customer?->currency_id) == $currency->id)>{{ $currency->code }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.status') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="status" value="{{ old('status', $customer?->status ?? 'active') }}">
    </div>
</div>
<div class="mt-4">
    <label class="text-sm">{{ __('messages.notes') }}</label>
    <textarea class="mt-1 w-full rounded border px-3 py-2" name="notes" rows="3">{{ old('notes', $customer?->notes) }}</textarea>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
