<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Orders Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #2196F3; color: white; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>Orders Report</h1>
    <p>Generated on: {{ now()->format('M d, Y H:i:s') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>Order Number</th>
                <th>Customer</th>
                <th>Amount</th>
                <th>Status</th>
                <th>Order Date</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($orders as $order)
                <tr>
                    <td>{{ $order->order_number }}</td>
                    <td>{{ $order->customer->name }}</td>
                    <td>${{ number_format($order->amount, 2) }}</td>
                    <td>{{ $order->status }}</td>
                    <td>{{ $order->order_date->format('M d, Y') }}</td>
                    <td>{{ $order->created_at->format('M d, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <p style="margin-top: 20px; font-size: 12px; color: #666;">
        Total Orders: <strong>{{ $orders->count() }}</strong> | 
        Total Revenue: <strong>${{ number_format($orders->sum('amount'), 2) }}</strong>
    </p>
</body>
</html>
