@csrf
<div class="row g-3">
    <div class="col-md-6"><label class="form-label">Title</label><input type="text" name="title" class="form-control" value="{{ old('title', $expense->title) }}" required></div>
    <div class="col-md-6"><label class="form-label">Category</label><input type="text" name="category" class="form-control" value="{{ old('category', $expense->category) }}" required></div>
    <div class="col-md-6"><label class="form-label">Amount</label><input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $expense->amount) }}" required></div>
    <div class="col-md-6"><label class="form-label">Expense Date</label><input type="date" name="expense_date" class="form-control" value="{{ old('expense_date', optional($expense->expense_date)->format('Y-m-d') ?? $expense->expense_date) }}" required></div>
    <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control">{{ old('notes', $expense->notes) }}</textarea></div>
</div>
