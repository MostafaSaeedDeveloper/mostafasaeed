<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.name') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="name" value="{{ old('name', $category?->name) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.type') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="type" value="{{ old('type', $category?->type) }}">
    </div>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
