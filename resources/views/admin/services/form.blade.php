@php($service = $service ?? new \App\Models\Service())
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.title_en') }}</label>
        <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $service->title['en'] ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.title_ar') }}</label>
        <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $service->title['ar'] ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.short_description_en') }}</label>
        <textarea name="short_description_en" class="form-control">{{ old('short_description_en', $service->short_description['en'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.short_description_ar') }}</label>
        <textarea name="short_description_ar" class="form-control">{{ old('short_description_ar', $service->short_description['ar'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.description_en') }}</label>
        <textarea name="description_en" class="form-control">{{ old('description_en', $service->description['en'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.description_ar') }}</label>
        <textarea name="description_ar" class="form-control">{{ old('description_ar', $service->description['ar'] ?? '') }}</textarea>
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.icon') }}</label>
        <input type="text" name="icon" class="form-control" value="{{ old('icon', $service->icon ?? '') }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.order') }}</label>
        <input type="number" name="order" class="form-control" value="{{ old('order', $service->order ?? 0) }}">
    </div>
    <div class="col-md-4">
        <label class="form-label">{{ __('app.status') }}</label>
        <select name="status" class="form-select">
            <option value="published" @selected(old('status', $service->status ?? '') === 'published')>{{ __('app.published') }}</option>
            <option value="draft" @selected(old('status', $service->status ?? '') === 'draft')>{{ __('app.draft') }}</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.seo_title_en') }}</label>
        <input type="text" name="seo_title_en" class="form-control" value="{{ old('seo_title_en', $service->seo_meta['title']['en'] ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.seo_title_ar') }}</label>
        <input type="text" name="seo_title_ar" class="form-control" value="{{ old('seo_title_ar', $service->seo_meta['title']['ar'] ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.seo_description_en') }}</label>
        <textarea name="seo_description_en" class="form-control">{{ old('seo_description_en', $service->seo_meta['description']['en'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.seo_description_ar') }}</label>
        <textarea name="seo_description_ar" class="form-control">{{ old('seo_description_ar', $service->seo_meta['description']['ar'] ?? '') }}</textarea>
    </div>
</div>
