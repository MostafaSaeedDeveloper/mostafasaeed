@extends('layouts.admin')
@section('title', 'Projects')
@section('page_title', 'Projects')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-end gap-3">
        <form method="GET" class="row g-2 w-100">
            <div class="col-md-4"><input type="text" name="search" class="form-control" placeholder="Search projects" value="{{ request('search') }}"></div>
            <div class="col-md-3"><select name="status" class="form-select"><option value="">All statuses</option>@foreach(['pending','in_progress','completed','cancelled'] as $status)<option value="{{ $status }}" @selected(request('status')===$status)>{{ ucfirst(str_replace('_',' ', $status)) }}</option>@endforeach</select></div>
            <div class="col-md-3"><select name="category" class="form-select"><option value="">All categories</option>@foreach(['laravel','wordpress','seo','media_buying','other'] as $category)<option value="{{ $category }}" @selected(request('category')===$category)>{{ ucfirst(str_replace('_',' ', $category)) }}</option>@endforeach</select></div>
            <div class="col-md-2"><button class="btn btn-outline-secondary">Filter</button></div>
        </form>
        <a href="{{ route('admin.projects.create') }}" class="btn btn-primary">Add Project</a>
    </div>
    <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Title</th><th>Client</th><th>Category</th><th>Status</th><th>Budget</th><th>Actions</th></tr></thead><tbody>
        @foreach($projects as $project)
        @php($map=['pending'=>'warning','in_progress'=>'primary','completed'=>'success','cancelled'=>'danger'])
        <tr><td>{{ $project->getTranslated('title') }}</td><td>{{ $project->client?->name }}</td><td>{{ ucfirst(str_replace('_',' ', $project->category)) }}</td><td><span class="badge text-bg-{{ $map[$project->status] ?? 'secondary' }}">{{ ucfirst(str_replace('_',' ', $project->status)) }}</span></td><td>{{ number_format($project->budget,2) }}</td><td class="d-flex gap-2"><a href="{{ route('admin.projects.show',$project) }}" class="btn btn-sm btn-outline-dark">Show</a><a href="{{ route('admin.projects.edit',$project) }}" class="btn btn-sm btn-outline-primary">Edit</a><form method="POST" action="{{ route('admin.projects.destroy',$project) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>
        @endforeach
    </tbody></table></div>
</div><div class="mt-3">{{ $projects->links() }}</div>
@endsection
