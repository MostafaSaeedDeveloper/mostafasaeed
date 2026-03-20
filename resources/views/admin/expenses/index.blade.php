@extends('layouts.admin')
@section('title', 'Expenses')
@section('page_title', 'Expenses')
@section('content')
<div class="card">
    <div class="card-header d-flex justify-content-between align-items-end gap-3">
        <form method="GET" class="row g-2 w-100"><div class="col-md-4"><input type="text" name="search" class="form-control" placeholder="Search expenses" value="{{ request('search') }}"></div><div class="col-md-3"><button class="btn btn-outline-secondary">Search</button></div></form>
        <a href="{{ route('admin.expenses.create') }}" class="btn btn-primary">Add Expense</a>
    </div>
    <div class="table-responsive"><table class="table mb-0"><thead><tr><th>Title</th><th>Category</th><th>Amount</th><th>Date</th><th>Actions</th></tr></thead><tbody>@foreach($expenses as $expense)<tr><td>{{ $expense->title }}</td><td>{{ $expense->category }}</td><td>{{ number_format($expense->amount,2) }}</td><td>{{ optional($expense->expense_date)->format('Y-m-d') }}</td><td class="d-flex gap-2"><a href="{{ route('admin.expenses.edit',$expense) }}" class="btn btn-sm btn-outline-primary">Edit</a><form method="POST" action="{{ route('admin.expenses.destroy',$expense) }}">@csrf @method('DELETE')<button class="btn btn-sm btn-outline-danger">Delete</button></form></td></tr>@endforeach</tbody><tfoot><tr><th colspan="2">Page Total</th><th>{{ number_format($totalAmount,2) }}</th><th colspan="2"></th></tr></tfoot></table></div>
</div><div class="mt-3">{{ $expenses->links() }}</div>
@endsection
