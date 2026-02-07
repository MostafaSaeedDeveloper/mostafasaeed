@csrf
<div class="row g-3">
<div class="col-md-6"><label class="form-label">{{ __('app.name') }}</label><input required name="name" class="form-control" value="{{ old('name',$customer->name) }}"></div>
<div class="col-md-6"><label class="form-label">Company</label><input name="company_name" class="form-control" value="{{ old('company_name',$customer->company_name) }}"></div>
<div class="col-md-6"><label class="form-label">{{ __('app.phone') }}</label><input name="phone" class="form-control" value="{{ old('phone',$customer->phone) }}"></div>
<div class="col-md-6"><label class="form-label">WhatsApp</label><input name="tax_number" class="form-control" value="{{ old('tax_number',$customer->tax_number) }}"></div>
<div class="col-md-6"><label class="form-label">{{ __('app.email') }}</label><input type="email" name="email" class="form-control" value="{{ old('email',$customer->email) }}"></div>
<div class="col-md-6"><label class="form-label">City/Country</label><input name="country" class="form-control" value="{{ old('country',$customer->country) }}"></div>
<div class="col-md-12"><label class="form-label">{{ __('app.address_en') }}</label><input name="address" class="form-control" value="{{ old('address',$customer->address) }}"></div>
<div class="col-md-6"><label class="form-label">Currency</label><select name="default_currency_id" class="form-select"><option value="">-</option>@foreach($currencies as $currency)<option value="{{ $currency->id }}" @selected(old('default_currency_id',$customer->default_currency_id)==$currency->id)>{{ $currency->code }}</option>@endforeach</select></div>
<div class="col-md-6"><label class="form-label">{{ __('app.status') }}</label><select name="status" class="form-select">@foreach(['lead','active','inactive'] as $status)<option value="{{ $status }}" @selected(old('status',$customer->status ?? 'active')===$status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
<div class="col-md-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control">{{ old('notes',$customer->notes) }}</textarea></div>
</div>
<button class="btn btn-primary mt-3">{{ __('app.save') }}</button>
