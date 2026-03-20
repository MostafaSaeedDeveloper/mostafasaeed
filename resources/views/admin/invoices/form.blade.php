@csrf
<div class="card"><div class="card-body"><div class="row g-3">
    <div class="col-md-4"><label class="form-label">Client</label><select name="client_id" id="client_id" class="form-select" required>@foreach($clients as $client)<option value="{{ $client->id }}" @selected(old('client_id', $invoice->client_id)==$client->id)>{{ $client->name }}</option>@endforeach</select></div>
    <div class="col-md-4"><label class="form-label">Project</label><select name="project_id" id="project_id" class="form-select"><option value="">Optional project</option>@foreach($projects as $project)<option value="{{ $project->id }}" data-client="{{ $project->client_id }}" @selected(old('project_id', $invoice->project_id)==$project->id)>{{ $project->getTranslated('title') }}</option>@endforeach</select></div>
    <div class="col-md-4"><label class="form-label">Invoice Number</label><input type="text" class="form-control" value="{{ old('invoice_number', $invoice->formatted_number) }}" readonly></div>
    <div class="col-md-3"><label class="form-label">Issue Date</label><input type="date" name="issue_date" class="form-control" value="{{ old('issue_date', optional($invoice->issue_date)->format('Y-m-d') ?? $invoice->issue_date) }}" required></div>
    <div class="col-md-3"><label class="form-label">Due Date</label><input type="date" name="due_date" class="form-control" value="{{ old('due_date', optional($invoice->due_date)->format('Y-m-d') ?? $invoice->due_date) }}" required></div>
    <div class="col-md-3"><label class="form-label">Currency</label><input type="text" name="currency" class="form-control" value="{{ old('currency', $invoice->currency ?? 'EGP') }}" required></div>
    <div class="col-md-3"><label class="form-label">Status</label><select name="status" class="form-select">@foreach(['draft','sent','paid','overdue','cancelled'] as $status)<option value="{{ $status }}" @selected(old('status', $invoice->status)===$status)>{{ ucfirst($status) }}</option>@endforeach</select></div>
    <div class="col-12"><label class="form-label">Line Items</label><div class="table-responsive"><table class="table" id="items-table"><thead><tr><th>Description</th><th>Quantity</th><th>Unit Price</th><th>Total</th><th></th></tr></thead><tbody>
        @php($items = old('items', $invoice->exists ? $invoice->items->toArray() : [['description' => '', 'quantity' => 1, 'unit_price' => 0]]) )
        @foreach($items as $index => $item)
        <tr>
            <td><input type="text" name="items[{{ $index }}][description]" class="form-control item-desc" value="{{ $item['description'] ?? '' }}" required></td>
            <td><input type="number" step="0.01" name="items[{{ $index }}][quantity]" class="form-control qty" value="{{ $item['quantity'] ?? 1 }}" required></td>
            <td><input type="number" step="0.01" name="items[{{ $index }}][unit_price]" class="form-control price" value="{{ $item['unit_price'] ?? 0 }}" required></td>
            <td><input type="text" class="form-control line-total" value="{{ number_format((($item['quantity'] ?? 1) * ($item['unit_price'] ?? 0)),2) }}" readonly></td>
            <td><button type="button" class="btn btn-outline-danger remove-row">×</button></td>
        </tr>
        @endforeach
    </tbody></table></div><button type="button" id="add-row" class="btn btn-outline-secondary btn-sm">Add Row</button></div>
    <div class="col-md-4"><label class="form-label">Tax %</label><input type="number" step="0.01" name="tax_percent" id="tax_percent" class="form-control" value="{{ old('tax_percent', $invoice->tax_percent ?? 0) }}"></div>
    <div class="col-md-4"><label class="form-label">Subtotal</label><input type="text" id="subtotal" class="form-control" readonly></div>
    <div class="col-md-4"><label class="form-label">Grand Total</label><input type="text" id="grand_total" class="form-control" readonly></div>
    <div class="col-12"><label class="form-label">Notes</label><textarea name="notes" class="form-control">{{ old('notes', $invoice->notes) }}</textarea></div>
</div></div><div class="card-footer"><button class="btn btn-primary">Save Invoice</button></div></div>
@push('scripts')
<script>
function filterProjects(){
  const clientId = $('#client_id').val();
  $('#project_id option').each(function(){
    if(!$(this).data('client')) return;
    $(this).toggle(String($(this).data('client')) === String(clientId));
  });
}
function recalc(){
  let subtotal=0;
  $('#items-table tbody tr').each(function(){
    const qty=parseFloat($(this).find('.qty').val()||0), price=parseFloat($(this).find('.price').val()||0), total=qty*price;
    $(this).find('.line-total').val(total.toFixed(2)); subtotal+=total;
  });
  const tax=subtotal*(parseFloat($('#tax_percent').val()||0)/100); $('#subtotal').val(subtotal.toFixed(2)); $('#grand_total').val((subtotal+tax).toFixed(2));
}
let rowIndex = $('#items-table tbody tr').length;
$('#add-row').on('click', function(){ $('#items-table tbody').append(`<tr><td><input type="text" name="items[${rowIndex}][description]" class="form-control item-desc" required></td><td><input type="number" step="0.01" name="items[${rowIndex}][quantity]" class="form-control qty" value="1" required></td><td><input type="number" step="0.01" name="items[${rowIndex}][unit_price]" class="form-control price" value="0" required></td><td><input type="text" class="form-control line-total" readonly></td><td><button type="button" class="btn btn-outline-danger remove-row">×</button></td></tr>`); rowIndex++; recalc(); });
$(document).on('input', '.qty, .price, #tax_percent', recalc);
$(document).on('click', '.remove-row', function(){ $(this).closest('tr').remove(); recalc(); });
$('#client_id').on('change', filterProjects); filterProjects(); recalc();
</script>
@endpush
