<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.title_en') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="title[en]" value="{{ old('title.en', $service?->title['en'] ?? '') }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.title_ar') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="title[ar]" value="{{ old('title.ar', $service?->title['ar'] ?? '') }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.short_description_en') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="short_description[en]" value="{{ old('short_description.en', $service?->short_description['en'] ?? '') }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.short_description_ar') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="short_description[ar]" value="{{ old('short_description.ar', $service?->short_description['ar'] ?? '') }}">
    </div>
    <div class="md:col-span-2">
        <label class="text-sm">{{ __('messages.description_en') }}</label>
        <textarea class="mt-1 w-full rounded border px-3 py-2" name="description[en]" rows="3">{{ old('description.en', $service?->description['en'] ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="text-sm">{{ __('messages.description_ar') }}</label>
        <textarea class="mt-1 w-full rounded border px-3 py-2" name="description[ar]" rows="3">{{ old('description.ar', $service?->description['ar'] ?? '') }}</textarea>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.icon') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="icon" value="{{ old('icon', $service?->icon) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.order') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="display_order" type="number" value="{{ old('display_order', $service?->display_order) }}">
    </div>
</div>
<div class="mt-4">
    <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_active" value="1" {{ old('is_active', $service?->is_active ?? true) ? 'checked' : '' }}>
        {{ __('messages.active') }}
    </label>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
