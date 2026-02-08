@csrf
<div class="card card-outline card-primary"><div class="card-body"><div class="row g-3">
<div class="col-md-4"><label>{{ __('app.customer') }}</label><select name="customer_id" class="form-control" required>@foreach($customers as $c)<option value="{{ $c->id }}" @selected(old('customer_id',$invoice->customer_id)==$c->id)>{{ $c->name }}</option>@endforeach</select></div>
<div class="col-md-4"><label>Project</label><select name="project_id" class="form-control"><option value="">-</option>@foreach($projects as $project)<option value="{{ $project->id }}" @selected(old('project_id',$invoice->project_id)==$project->id)>{{ data_get($project->title,app()->getLocale()) }}</option>@endforeach</select></div>
<div class="col-md-4"><label>Prefix</label><input name="invoice_prefix" class="form-control" value="{{ old('invoice_prefix',$invoice->invoice_prefix ?? 'INV-') }}"></div>
<div class="col-md-3"><label>Issue Date</label><input type="date" name="issue_date" class="form-control" value="{{ old('issue_date',optional($invoice->issue_date)->format('Y-m-d') ?? $invoice->issue_date) }}"></div>
<div class="col-md-3"><label>{{ __('app.due_date') }}</label><input type="date" name="due_date" class="form-control" value="{{ old('due_date',optional($invoice->due_date)->format('Y-m-d')) }}"></div>
<div class="col-md-3"><label>Currency</label><select name="currency_id" class="form-control"><option value="">-</option>@foreach($currencies as $currency)<option value="{{ $currency->id }}" @selected(old('currency_id',$invoice->currency_id)==$currency->id)>{{ $currency->code }}</option>@endforeach</select></div>
<div class="col-md-3"><label>{{ __('app.status') }}</label><select name="status" class="form-control">@foreach(['draft','sent','paid','partially_paid','overdue','cancelled'] as $s)<option value="{{ $s }}" @selected(old('status',$invoice->status ?? 'draft')===$s)>{{ ucfirst(str_replace('_',' ',$s)) }}</option>@endforeach</select></div>
<div class="col-12"><label>Items</label><div id="items-wrap">@php $items = old('items', isset($invoice) ? $invoice->items->toArray() : [['name'=>'','qty'=>1,'unit_price'=>0,'line_discount'=>0]]); @endphp
@foreach($items as $idx => $item)
<div class="row g-2 mb-2 item-row"><div class="col-md-5"><input class="form-control" name="items[{{ $idx }}][name]" placeholder="Service/Item" value="{{ $item['name'] ?? '' }}"></div><div class="col-md-2"><input class="form-control" type="number" step="0.01" name="items[{{ $idx }}][qty]" value="{{ $item['qty'] ?? 1 }}" placeholder="Qty"></div><div class="col-md-2"><input class="form-control" type="number" step="0.01" name="items[{{ $idx }}][unit_price]" value="{{ $item['unit_price'] ?? 0 }}" placeholder="Unit"></div><div class="col-md-2"><input class="form-control" type="number" step="0.01" name="items[{{ $idx }}][line_discount]" value="{{ $item['line_discount'] ?? 0 }}" placeholder="Disc"></div><div class="col-md-1"><button type="button" class="btn btn-outline-danger remove-item">X</button></div></div>
@endforeach
</div><button id="add-item" type="button" class="btn btn-sm btn-outline-secondary">+ Item</button></div>
<div class="col-md-4"><label>Discount</label><input name="discount" type="number" step="0.01" class="form-control" value="{{ old('discount',$invoice->discount ?? 0) }}"></div>
<div class="col-md-4"><label>Tax</label><input name="tax" type="number" step="0.01" class="form-control" value="{{ old('tax',$invoice->tax ?? 0) }}"></div>
<div class="col-md-4"><label>Grand Total</label><input class="form-control" value="{{ number_format($invoice->total ?? 0,2) }}" disabled></div>
<div class="col-12"><label>Notes</label><textarea name="notes" class="form-control" rows="3">{{ old('notes',$invoice->notes) }}</textarea></div>
</div></div><div class="card-footer text-right"><button class="btn btn-primary">{{ __('app.save') }}</button></div></div>
@push('scripts')
<script>
let idx=document.querySelectorAll('.item-row').length;
document.getElementById('add-item').addEventListener('click',()=>{document.getElementById('items-wrap').insertAdjacentHTML('beforeend',`<div class="row g-2 mb-2 item-row"><div class="col-md-5"><input class="form-control" name="items[${idx}][name]" placeholder="Service/Item"></div><div class="col-md-2"><input class="form-control" type="number" step="0.01" name="items[${idx}][qty]" value="1"></div><div class="col-md-2"><input class="form-control" type="number" step="0.01" name="items[${idx}][unit_price]" value="0"></div><div class="col-md-2"><input class="form-control" type="number" step="0.01" name="items[${idx}][line_discount]" value="0"></div><div class="col-md-1"><button type="button" class="btn btn-outline-danger remove-item">X</button></div></div>`);idx++;});
document.addEventListener('click',(e)=>{if(e.target.classList.contains('remove-item')) e.target.closest('.item-row').remove();});
</script>
@endpush
