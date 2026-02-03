<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.code') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="code" value="{{ old('code', $currency?->code) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.symbol') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="symbol" value="{{ old('symbol', $currency?->symbol) }}">
    </div>
</div>
<div class="mt-4 flex items-center gap-4">
    <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_base" value="1" {{ old('is_base', $currency?->is_base ?? false) ? 'checked' : '' }}>
        {{ __('messages.base_currency') }}
    </label>
    <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_enabled" value="1" {{ old('is_enabled', $currency?->is_enabled ?? true) ? 'checked' : '' }}>
        {{ __('messages.enabled') }}
    </label>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
