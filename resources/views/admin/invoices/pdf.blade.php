<!doctype html>
<html><head><meta charset="utf-8"><style>body{font-family:DejaVu Sans,sans-serif;font-size:12px}table{width:100%;border-collapse:collapse}th,td{border:1px solid #ccc;padding:8px}h1,h3,p{margin:0 0 8px}</style></head><body>
<h1>{{ $settings?->brand_name ?? 'Mostafa Saeed' }}</h1>
<p>{{ $settings?->contact_email }} | {{ $settings?->contact_phone }}</p>
<h3>Invoice {{ $invoice->formatted_number }}</h3>
<p>Client: {{ $invoice->client?->name }}</p>
<p>Issue Date: {{ $invoice->issue_date?->format('Y-m-d') }} | Due Date: {{ $invoice->due_date?->format('Y-m-d') }}</p>
<table><thead><tr><th>Description</th><th>Qty</th><th>Unit Price</th><th>Total</th></tr></thead><tbody>@foreach($invoice->items as $item)<tr><td>{{ $item->description }}</td><td>{{ $item->quantity }}</td><td>{{ number_format($item->unit_price,2) }}</td><td>{{ number_format($item->total,2) }}</td></tr>@endforeach</tbody></table>
<table style="margin-top:20px"><tr><th>Subtotal</th><td>{{ number_format($invoice->subtotal,2) }}</td></tr><tr><th>Tax</th><td>{{ number_format($invoice->tax_amount,2) }}</td></tr><tr><th>Total</th><td>{{ number_format($invoice->total,2) }}</td></tr></table>
</body></html>
