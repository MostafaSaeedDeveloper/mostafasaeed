@csrf
<div class="row g-3">
<div class="col-md-3"><label class="form-label">{{ __('app.date') }}</label><input type="date" name="date" class="form-control" value="{{ old('date',optional($expense->date)->format('Y-m-d') ?? $expense->date) }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('app.category') }}</label><select name="expense_category_id" class="form-select"><option value="">-</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" @selected(old('expense_category_id',$expense->expense_category_id)==$cat->id)>{{ $cat->name }}</option>@endforeach</select></div>
<div class="col-md-3"><label class="form-label">{{ __('app.amount') }}</label><input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount',$expense->amount) }}"></div>
<div class="col-md-3"><label class="form-label">Currency</label><select name="currency_id" class="form-select"><option value="">-</option>@foreach($currencies as $c)<option value="{{ $c->id }}" @selected(old('currency_id',$expense->currency_id)==$c->id)>{{ $c->code }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">{{ __('app.account') }}</label><select name="account_id" class="form-select"><option value="">-</option>@foreach($accounts as $a)<option value="{{ $a->id }}" @selected(old('account_id',$expense->account_id)==$a->id)>{{ $a->name }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">Vendor</label><input name="vendor" class="form-control" value="{{ old('vendor',$expense->vendor) }}"></div>
<div class="col-12"><label class="form-label">Attachment</label><input type="file" name="receipt" class="form-control">@if($expense->receipt_path)<a href="{{ asset($expense->receipt_path) }}" target="_blank">Current file</a>@endif</div>
<div class="col-12"><textarea name="notes" class="form-control">{{ old('notes',$expense->notes) }}</textarea></div></div><button class="btn btn-primary mt-3">{{ __('app.save') }}</button>
