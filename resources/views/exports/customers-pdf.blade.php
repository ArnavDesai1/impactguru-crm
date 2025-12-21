<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Customers Report</title>
    <style>
        body { font-family: Arial, sans-serif; }
        table { width: 100%; border-collapse: collapse; margin-top: 20px; }
        th, td { border: 1px solid #ddd; padding: 8px; text-align: left; }
        th { background-color: #4CAF50; color: white; }
        h1 { color: #333; }
    </style>
</head>
<body>
    <h1>Customers Report</h1>
    <p>Generated on: {{ now()->format('M d, Y H:i:s') }}</p>
    
    <table>
        <thead>
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Address</th>
                <th>Created At</th>
            </tr>
        </thead>
        <tbody>
            @foreach($customers as $customer)
                <tr>
                    <td>{{ $customer->id }}</td>
                    <td>{{ $customer->name }}</td>
                    <td>{{ $customer->email }}</td>
                    <td>{{ $customer->phone }}</td>
                    <td>{{ $customer->address }}</td>
                    <td>{{ $customer->created_at->format('M d, Y') }}</td>
                </tr>
            @endforeach
        </tbody>
    </table>
    
    <p style="margin-top: 20px; font-size: 12px; color: #666;">
        Total Customers: <strong>{{ $customers->count() }}</strong>
    </p>
</body>
</html>
