<!doctype html>
<html lang="{{ app()->getLocale() }}" dir="{{ app(\App\Services\LocalizationService::class)->direction() }}">
<head>
    <meta charset="utf-8">
    <style>
        body { font-family: DejaVu Sans, sans-serif; }
        table { width: 100%; border-collapse: collapse; }
        th, td { border: 1px solid #ddd; padding: 8px; }
    </style>
</head>
<body>
    <h1>{{ __('messages.invoice') }} {{ $invoice->number }}</h1>
    <p>{{ __('messages.customer') }}: {{ $invoice->customer?->name }}</p>
    <p>{{ __('messages.issue_date') }}: {{ $invoice->issue_date?->format('Y-m-d') }}</p>
    <table>
        <thead>
            <tr>
                <th>{{ __('messages.item_name') }}</th>
                <th>{{ __('messages.quantity') }}</th>
                <th>{{ __('messages.unit_price') }}</th>
                <th>{{ __('messages.total') }}</th>
            </tr>
        </thead>
        <tbody>
            @foreach($invoice->items as $item)
                <tr>
                    <td>{{ $item->name }}</td>
                    <td>{{ $item->quantity }}</td>
                    <td>{{ $item->unit_price }}</td>
                    <td>{{ $item->line_total }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    <p>{{ __('messages.subtotal') }}: {{ $invoice->subtotal }}</p>
    <p>{{ __('messages.discount') }}: {{ $invoice->discount }}</p>
    <p>{{ __('messages.tax') }}: {{ $invoice->tax }}</p>
    <p>{{ __('messages.total') }}: {{ $invoice->total }}</p>
</body>
</html>
