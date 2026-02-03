<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.name') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="name" value="{{ old('name', $client?->name) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.website') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="website" value="{{ old('website', $client?->website) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.logo') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="logo" value="{{ old('logo', $client?->logo) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.order') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="display_order" type="number" value="{{ old('display_order', $client?->display_order) }}">
    </div>
</div>
<div class="mt-4">
    <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $client?->is_featured ?? false) ? 'checked' : '' }}>
        {{ __('messages.featured') }}
    </label>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
