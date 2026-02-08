@csrf
<div class="card card-primary card-outline"><div class="card-body"><div class="row g-3">
<div class="col-md-6"><label>{{ __('app.customer') }}</label><select name="customer_id" class="form-control"><option value="">-</option>@foreach($customers as $c)<option value="{{ $c->id }}" @selected(old('customer_id',$payment->customer_id)==$c->id)>{{ $c->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label>{{ __('app.invoice_number') }}</label><select name="invoice_id" class="form-control"><option value="">-</option>@foreach($invoices as $invoice)<option value="{{ $invoice->id }}" @selected(old('invoice_id',$payment->invoice_id)==$invoice->id)>#{{ $invoice->invoice_number }}</option>@endforeach</select></div>
<div class="col-md-3"><label>{{ __('app.amount') }}</label><input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount',$payment->amount) }}"></div>
<div class="col-md-3"><label>Currency</label><select name="currency_id" class="form-control"><option value="">-</option>@foreach($currencies as $c)<option value="{{ $c->id }}" @selected(old('currency_id',$payment->currency_id)==$c->id)>{{ $c->code }}</option>@endforeach</select></div>
<div class="col-md-3"><label>Payment Method</label><select name="payment_method_id" class="form-control" required>@foreach($methods as $m)<option value="{{ $m->id }}" @selected(old('payment_method_id',$payment->payment_method_id)===$m->id)>{{ $m->name }}</option>@endforeach</select></div>
<div class="col-md-3"><label>{{ __('app.date') }}</label><input type="date" name="date" class="form-control" value="{{ old('date',optional($payment->date)->format('Y-m-d') ?? $payment->date) }}"></div>
<div class="col-md-6"><label>{{ __('app.account') }}</label><select name="account_id" class="form-control"><option value="">-</option>@foreach($accounts as $a)<option value="{{ $a->id }}" @selected(old('account_id',$payment->account_id)==$a->id)>{{ $a->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label>Reference</label><input name="reference" class="form-control" value="{{ old('reference',$payment->reference) }}"></div>
<div class="col-12"><label>Notes</label><textarea name="notes" class="form-control">{{ old('notes',$payment->notes) }}</textarea></div>
</div></div><div class="card-footer text-right"><button class="btn btn-primary">{{ __('app.save') }}</button></div></div>
