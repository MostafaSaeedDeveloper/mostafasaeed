@csrf
<div class="card"><div class="card-body"><div class="row g-3">
    <div class="col-md-6"><label class="form-label">Invoice</label><select name="invoice_id" class="form-select" required>@foreach($invoices as $invoice)<option value="{{ $invoice->id }}" @selected(old('invoice_id', $payment->invoice_id)==$invoice->id)>{{ $invoice->invoice_number }} - {{ $invoice->client?->name }}</option>@endforeach</select></div>
    <div class="col-md-6"><label class="form-label">Amount</label><input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount', $payment->amount) }}" required></div>
    <div class="col-md-6"><label class="form-label">Payment Date</label><input type="date" name="payment_date" class="form-control" value="{{ old('payment_date', optional($payment->payment_date)->format('Y-m-d') ?? $payment->payment_date) }}" required></div>
    <div class="col-md-6"><label class="form-label">Method</label><input type="text" name="method" class="form-control" value="{{ old('method', $payment->method) }}" required></div>
    <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control">{{ old('notes', $payment->notes) }}</textarea></div>
</div></div><div class="card-footer"><button class="btn btn-primary">Save Payment</button></div></div>
