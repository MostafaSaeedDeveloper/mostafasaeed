@extends('layouts.admin')
@section('title', 'Clients')
@section('page_title', 'Clients')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-end gap-3">
        <form method="GET" class="row g-2 w-100">
            <div class="col-md-4"><input type="text" name="search" class="form-control" placeholder="Search clients" value="{{ request('search') }}"></div>
            <div class="col-md-4"><button class="btn btn-outline-secondary">Search</button></div>
        </form>
        <a href="{{ route('admin.clients.create') }}" class="btn btn-primary">Add Client</a>
    </div>
    <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Name</th><th>Company</th><th>Email</th><th>Phone</th><th>Actions</th></tr></thead><tbody>
        @foreach($clients as $client)
        <tr>
            <td>{{ $client->name }}</td><td>{{ $client->company }}</td><td>{{ $client->email }}</td><td>{{ $client->phone }}</td>
            <td class="d-flex gap-2"><a href="{{ route('admin.clients.show', $client) }}" class="btn btn-sm btn-outline-dark">Show</a><a href="{{ route('admin.clients.edit', $client) }}" class="btn btn-sm btn-outline-primary">Edit</a><form method="POST" action="{{ route('admin.clients.destroy', $client) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td>
        </tr>
        @endforeach
    </tbody></table></div>
</div>
<div class="mt-3">{{ $clients->links() }}</div>
@endsection
