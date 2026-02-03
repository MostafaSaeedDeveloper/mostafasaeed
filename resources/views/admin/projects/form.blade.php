@php($project = $project ?? new \App\Models\Project())
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.title_en') }}</label>
        <input type="text" name="title_en" class="form-control" value="{{ old('title_en', $project->title['en'] ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.title_ar') }}</label>
        <input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $project->title['ar'] ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.slug') }}</label>
        <input type="text" name="slug" class="form-control" value="{{ old('slug', $project->slug ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.category') }}</label>
        <input type="text" name="category" class="form-control" value="{{ old('category', $project->category ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.summary_en') }}</label>
        <textarea name="summary_en" class="form-control">{{ old('summary_en', $project->summary['en'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.summary_ar') }}</label>
        <textarea name="summary_ar" class="form-control">{{ old('summary_ar', $project->summary['ar'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.case_study_en') }}</label>
        <textarea name="case_study_en" class="form-control">{{ old('case_study_en', $project->case_study['en'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.case_study_ar') }}</label>
        <textarea name="case_study_ar" class="form-control">{{ old('case_study_ar', $project->case_study['ar'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.tech_stack') }} (comma separated)</label>
        <input type="text" name="tech_stack" class="form-control" value="{{ old('tech_stack', isset($project) ? implode(', ', $project->tech_stack ?? []) : '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.main_image') }}</label>
        <input type="file" name="main_image" class="form-control">
        @if(!empty($project->main_image_path))
            <small class="text-muted">{{ $project->main_image_path }}</small>
        @endif
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.gallery') }}</label>
        <input type="file" name="gallery[]" class="form-control" multiple>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.status') }}</label>
        <select name="status" class="form-select">
            <option value="published" @selected(old('status', $project->status ?? '') === 'published')>{{ __('app.published') }}</option>
            <option value="draft" @selected(old('status', $project->status ?? '') === 'draft')>{{ __('app.draft') }}</option>
        </select>
    </div>
    @php($featuredValue = (int) old('featured', $project->featured ? 1 : 0))
    <div class="col-md-6">
        <label class="form-label">{{ __('app.featured') }}</label>
        <select name="featured" class="form-select">
            <option value="1" @selected($featuredValue === 1)>{{ __('app.yes') }}</option>
            <option value="0" @selected($featuredValue === 0)>{{ __('app.no') }}</option>
        </select>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.live_url') }}</label>
        <input type="text" name="live_url" class="form-control" value="{{ old('live_url', $project->live_url ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.repo_url') }}</label>
        <input type="text" name="repo_url" class="form-control" value="{{ old('repo_url', $project->repo_url ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.seo_title_en') }}</label>
        <input type="text" name="seo_title_en" class="form-control" value="{{ old('seo_title_en', $project->seo_meta['title']['en'] ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.seo_title_ar') }}</label>
        <input type="text" name="seo_title_ar" class="form-control" value="{{ old('seo_title_ar', $project->seo_meta['title']['ar'] ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.seo_description_en') }}</label>
        <textarea name="seo_description_en" class="form-control">{{ old('seo_description_en', $project->seo_meta['description']['en'] ?? '') }}</textarea>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.seo_description_ar') }}</label>
        <textarea name="seo_description_ar" class="form-control">{{ old('seo_description_ar', $project->seo_meta['description']['ar'] ?? '') }}</textarea>
    </div>
</div>
