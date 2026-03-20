@csrf
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Title (EN)</label><input type="text" name="title_en" class="form-control" value="{{ old('title_en', $project->title['en'] ?? '') }}" required></div>
    <div class="col-md-6"><label class="form-label">Title (AR)</label><input type="text" name="title_ar" class="form-control" value="{{ old('title_ar', $project->title['ar'] ?? '') }}" required></div>
    <div class="col-md-6"><label class="form-label">Client</label><select name="client_id" class="form-select" required>@foreach($clients as $client)<option value="{{ $client->id }}" @selected(old('client_id', $project->client_id)==$client->id)>{{ $client->name }}</option>@endforeach</select></div>
    <div class="col-md-6"><label class="form-label">Category</label><select name="category" class="form-select" required>@foreach(['laravel','wordpress','seo','media_buying','other'] as $category)<option value="{{ $category }}" @selected(old('category', $project->category)===$category)>{{ ucfirst(str_replace('_',' ', $category)) }}</option>@endforeach</select></div>
    <div class="col-md-6"><label class="form-label">Status</label><select name="status" class="form-select" required>@foreach(['pending','in_progress','completed','cancelled'] as $status)<option value="{{ $status }}" @selected(old('status', $project->status)===$status)>{{ ucfirst(str_replace('_',' ', $status)) }}</option>@endforeach</select></div>
    <div class="col-md-6"><label class="form-label">Slug</label><input type="text" name="slug" class="form-control" value="{{ old('slug', $project->slug) }}"></div>
    <div class="col-md-6"><label class="form-label">Start Date</label><input type="date" name="start_date" class="form-control" value="{{ old('start_date', optional($project->start_date)->format('Y-m-d')) }}"></div>
    <div class="col-md-6"><label class="form-label">End Date</label><input type="date" name="end_date" class="form-control" value="{{ old('end_date', optional($project->end_date)->format('Y-m-d')) }}"></div>
    <div class="col-md-6"><label class="form-label">Budget</label><input type="number" step="0.01" name="budget" class="form-control" value="{{ old('budget', $project->budget) }}"></div>
    <div class="col-md-6"><label class="form-label">Tech Stack</label><input type="text" name="tech_stack" class="form-control" value="{{ old('tech_stack', implode(', ', $project->tech_stack ?? [])) }}"></div>
    <div class="col-12"><label class="form-label">Description</label><textarea name="description" class="form-control">{{ old('description', $project->description) }}</textarea></div>
    <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control">{{ old('notes', $project->notes) }}</textarea></div>
</div>
