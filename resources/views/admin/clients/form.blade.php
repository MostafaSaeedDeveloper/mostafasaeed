@php($client = $client ?? new \App\Models\Client())
<div class="row g-3">
    <div class="col-md-6">
        <label class="form-label">{{ __('app.name') }}</label>
        <input type="text" name="name" class="form-control" value="{{ old('name', $client->name ?? '') }}" required>
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.website') }}</label>
        <input type="text" name="website" class="form-control" value="{{ old('website', $client->website ?? '') }}">
    </div>
    <div class="col-md-6">
        <label class="form-label">{{ __('app.logo') }}</label>
        <input type="file" name="logo" class="form-control">
        @if(!empty($client->logo_path))
            <small class="text-muted">{{ $client->logo_path }}</small>
        @endif
    </div>
    @php($featuredValue = (int) old('featured', $client->featured ? 1 : 0))
    <div class="col-md-3">
        <label class="form-label">{{ __('app.featured') }}</label>
        <select name="featured" class="form-select">
            <option value="1" @selected($featuredValue === 1)>{{ __('app.yes') }}</option>
            <option value="0" @selected($featuredValue === 0)>{{ __('app.no') }}</option>
        </select>
    </div>
    <div class="col-md-3">
        <label class="form-label">{{ __('app.order') }}</label>
        <input type="number" name="order" class="form-control" value="{{ old('order', $client->order ?? 0) }}">
    </div>
</div>
