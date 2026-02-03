<div class="grid gap-4 md:grid-cols-2">
    <div>
        <label class="text-sm">{{ __('messages.title_en') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="title[en]" value="{{ old('title.en', $project?->title['en'] ?? '') }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.title_ar') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="title[ar]" value="{{ old('title.ar', $project?->title['ar'] ?? '') }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.slug') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="slug" value="{{ old('slug', $project?->slug) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.category') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="category" value="{{ old('category', $project?->category) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.client') }}</label>
        <select class="mt-1 w-full rounded border px-3 py-2" name="client_id">
            <option value="">{{ __('messages.select') }}</option>
            @foreach($clients as $client)
                <option value="{{ $client->id }}" @selected(old('client_id', $project?->client_id) == $client->id)>{{ $client->name }}</option>
            @endforeach
        </select>
    </div>
    <div>
        <label class="text-sm">{{ __('messages.live_url') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="live_url" value="{{ old('live_url', $project?->live_url) }}">
    </div>
    <div>
        <label class="text-sm">{{ __('messages.repo_url') }}</label>
        <input class="mt-1 w-full rounded border px-3 py-2" name="repo_url" value="{{ old('repo_url', $project?->repo_url) }}">
    </div>
    <div class="md:col-span-2">
        <label class="text-sm">{{ __('messages.summary_en') }}</label>
        <textarea class="mt-1 w-full rounded border px-3 py-2" name="summary[en]" rows="2">{{ old('summary.en', $project?->summary['en'] ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="text-sm">{{ __('messages.summary_ar') }}</label>
        <textarea class="mt-1 w-full rounded border px-3 py-2" name="summary[ar]" rows="2">{{ old('summary.ar', $project?->summary['ar'] ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="text-sm">{{ __('messages.case_study_en') }}</label>
        <textarea class="mt-1 w-full rounded border px-3 py-2" name="case_study[en]" rows="3">{{ old('case_study.en', $project?->case_study['en'] ?? '') }}</textarea>
    </div>
    <div class="md:col-span-2">
        <label class="text-sm">{{ __('messages.case_study_ar') }}</label>
        <textarea class="mt-1 w-full rounded border px-3 py-2" name="case_study[ar]" rows="3">{{ old('case_study.ar', $project?->case_study['ar'] ?? '') }}</textarea>
    </div>
</div>
<div class="mt-4 flex items-center gap-4">
    <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_featured" value="1" {{ old('is_featured', $project?->is_featured ?? false) ? 'checked' : '' }}>
        {{ __('messages.featured') }}
    </label>
    <label class="inline-flex items-center gap-2 text-sm">
        <input type="checkbox" name="is_published" value="1" {{ old('is_published', $project?->is_published ?? true) ? 'checked' : '' }}>
        {{ __('messages.published') }}
    </label>
</div>
<button class="mt-4 rounded bg-slate-900 px-4 py-2 text-white" type="submit">{{ __('messages.save') }}</button>
