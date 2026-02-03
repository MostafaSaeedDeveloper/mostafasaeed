@extends('layouts.admin')

@section('title', __('app.profile'))

@section('content')
@php($profile = $profile ?? new \App\Models\Profile())
<form method="POST" action="{{ route('admin.profile.update') }}" class="card p-4" enctype="multipart/form-data">
    @csrf
    @method('PUT')
    <div class="row g-3">
        <div class="col-md-6">
            <label class="form-label">{{ __('app.name') }}</label>
            <input type="text" name="name" class="form-control" value="{{ old('name', $profile->name ?? '') }}" required>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.titles_en') }}</label>
            <input type="text" name="titles_en" class="form-control" value="{{ old('titles_en', $profile->titles['en'] ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.titles_ar') }}</label>
            <input type="text" name="titles_ar" class="form-control" value="{{ old('titles_ar', $profile->titles['ar'] ?? '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.skills') }} (comma separated)</label>
            <input type="text" name="skills" class="form-control" value="{{ old('skills', isset($profile) ? implode(', ', $profile->skills ?? []) : '') }}">
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.bio_en') }}</label>
            <textarea name="bio_en" class="form-control">{{ old('bio_en', $profile->bio['en'] ?? '') }}</textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.bio_ar') }}</label>
            <textarea name="bio_ar" class="form-control">{{ old('bio_ar', $profile->bio['ar'] ?? '') }}</textarea>
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.profile_image') }}</label>
            <input type="file" name="profile_image" class="form-control">
            @if(!empty($profile->profile_image_path))
                <small class="text-muted">{{ $profile->profile_image_path }}</small>
            @endif
        </div>
        <div class="col-md-6">
            <label class="form-label">{{ __('app.cv') }}</label>
            <input type="file" name="cv" class="form-control">
            @if(!empty($profile->cv_path))
                <small class="text-muted">{{ $profile->cv_path }}</small>
            @endif
        </div>
    </div>
    <button class="btn btn-primary mt-3">{{ __('app.save') }}</button>
</form>
@endsection
