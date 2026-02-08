<!doctype html><html><head><meta charset="utf-8"><style>body{font-family:DejaVu Sans,sans-serif;color:#1f2937;font-size:12px}.table{width:100%;border-collapse:collapse}th,td{border:1px solid #ddd;padding:6px}th{background:#f3f4f6}.text-right{text-align:right}</style></head><body>
<h2>{{ $settings?->brand_name ?? 'Mostafa CMS' }}</h2>
<p>{{ $settings?->contact_email }} | {{ $settings?->contact_phone }}</p>
<hr>
<table width="100%"><tr><td><strong>Client:</strong> {{ $invoice->customer?->name }}</td><td class="text-right"><strong>Invoice:</strong> {{ $invoice->invoice_prefix ?? 'INV-' }}{{ str_pad($invoice->invoice_number,6,'0',STR_PAD_LEFT) }}<br><strong>Date:</strong> {{ optional($invoice->issue_date)->format('Y-m-d') }}<br><strong>Due:</strong> {{ optional($invoice->due_date)->format('Y-m-d') }}</td></tr></table>
<br>
<table class="table"><thead><tr><th>Item</th><th>Qty</th><th>Unit</th><th>Discount</th><th>Total</th></tr></thead><tbody>@foreach($invoice->items as $item)<tr><td>{{ $item->name }}</td><td>{{ $item->qty }}</td><td>{{ number_format($item->unit_price,2) }}</td><td>{{ number_format($item->line_discount,2) }}</td><td>{{ number_format($item->line_total,2) }}</td></tr>@endforeach</tbody></table>
<table width="40%" align="right" class="table"><tr><th>Subtotal</th><td>{{ number_format($invoice->subtotal,2) }}</td></tr><tr><th>Discount</th><td>{{ number_format($invoice->discount,2) }}</td></tr><tr><th>Tax</th><td>{{ number_format($invoice->tax,2) }}</td></tr><tr><th>Total</th><td>{{ number_format($invoice->total,2) }}</td></tr><tr><th>Paid</th><td>{{ number_format($invoice->paid_amount ?? 0,2) }}</td></tr><tr><th>Due</th><td>{{ number_format($invoice->due_amount ?? $invoice->total,2) }}</td></tr></table>
</body></html>
