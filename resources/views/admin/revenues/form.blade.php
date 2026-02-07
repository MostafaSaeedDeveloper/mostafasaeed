@csrf
<div class="row g-3">
<div class="col-md-3"><label class="form-label">{{ __('app.date') }}</label><input type="date" name="date" class="form-control" value="{{ old('date',optional($revenue->date)->format('Y-m-d') ?? $revenue->date) }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('app.category') }}</label><select name="income_category_id" class="form-select"><option value="">-</option>@foreach($categories as $cat)<option value="{{ $cat->id }}" @selected(old('income_category_id',$revenue->income_category_id)==$cat->id)>{{ $cat->name }}</option>@endforeach</select></div>
<div class="col-md-3"><label class="form-label">Source</label><input name="source" class="form-control" value="{{ old('source',$revenue->source) }}"></div>
<div class="col-md-3"><label class="form-label">{{ __('app.amount') }}</label><input type="number" step="0.01" name="amount" class="form-control" value="{{ old('amount',$revenue->amount) }}"></div>
<div class="col-md-6"><label class="form-label">Currency</label><select name="currency_id" class="form-select"><option value="">-</option>@foreach($currencies as $c)<option value="{{ $c->id }}" @selected(old('currency_id',$revenue->currency_id)==$c->id)>{{ $c->code }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">{{ __('app.account') }}</label><select name="account_id" class="form-select"><option value="">-</option>@foreach($accounts as $a)<option value="{{ $a->id }}" @selected(old('account_id',$revenue->account_id)==$a->id)>{{ $a->name }}</option>@endforeach</select></div>
<div class="col-12"><textarea name="notes" class="form-control">{{ old('notes',$revenue->notes) }}</textarea></div>
</div><button class="btn btn-primary mt-3">{{ __('app.save') }}</button>
