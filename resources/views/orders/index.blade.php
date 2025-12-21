<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900">Orders</h2>
            <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ $orders->total() }} total</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header with Action Button -->
            <div class="mb-8 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Order Management</h1>
                <a href="{{ route('orders.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg shadow-lg transition duration-200 inline-flex items-center gap-2">
                    <span>+</span> New Order
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg">
                    <p class="text-green-700 font-medium">✓ {{ session('success') }}</p>
                </div>
            @endif

            <!-- Filter & Export Section -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <form method="GET" class="flex gap-2">
                        <select name="status" class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                            <option value="">All Statuses</option>
                            <option value="Pending" @selected(request('status') === 'Pending')>⏳ Pending</option>
                            <option value="Completed" @selected(request('status') === 'Completed')>✓ Completed</option>
                            <option value="Cancelled" @selected(request('status') === 'Cancelled')>✗ Cancelled</option>
                        </select>
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition duration-200 font-medium">Filter</button>
                        <a href="{{ route('orders.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition duration-200 font-medium">Clear</a>
                    </form>

                    <!-- Export Buttons -->
                    <div class="flex gap-2 justify-end">
                        <a href="{{ route('export.orders.csv') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200 font-medium text-sm">⬇ CSV</a>
                        <a href="{{ route('export.orders.pdf') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200 font-medium text-sm">⬇ PDF</a>
                    </div>
                </div>
            </div>

            <!-- Orders Table -->
            @if($orders->count() > 0)
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <table class="w-full">
                        <thead class="bg-gray-50 border-b border-gray-200">
                            <tr>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Order #</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Customer</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Amount</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Status</th>
                                <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Date</th>
                                <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($orders as $order)
                                <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-gray-900 bg-gray-100 px-3 py-1 rounded-lg text-sm">{{ $order->order_number }}</span>
                                    </td>
                                    <td class="px-6 py-4">
                                        <div class="flex items-center gap-2">
                                            <div class="w-8 h-8 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white text-sm font-bold">
                                                {{ substr($order->customer->name, 0, 1) }}
                                            </div>
                                            <div>
                                                <p class="font-medium text-gray-900">{{ $order->customer->name }}</p>
                                                <p class="text-xs text-gray-500">{{ $order->customer->email }}</p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="px-6 py-4">
                                        <span class="font-bold text-green-600 text-lg">${{ number_format($order->amount, 2) }}</span>
                                    </td>
                                    <td class="px-6 py-4 text-center">
                                        @if($order->status === 'Completed')
                                            <span class="inline-flex items-center gap-1 bg-green-100 text-green-800 px-3 py-1 rounded-full text-sm font-semibold">✓ Completed</span>
                                        @elseif($order->status === 'Pending')
                                            <span class="inline-flex items-center gap-1 bg-yellow-100 text-yellow-800 px-3 py-1 rounded-full text-sm font-semibold">⏳ Pending</span>
                                        @else
                                            <span class="inline-flex items-center gap-1 bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">✗ Cancelled</span>
                                        @endif
                                    </td>
                                    <td class="px-6 py-4 text-gray-600">{{ $order->order_date->format('M d, Y') }}</td>
                                    <td class="px-6 py-4 text-center">
                                        <div class="flex gap-2 justify-center">
                                            <a href="{{ route('orders.show', $order) }}" class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-lg text-sm font-medium transition duration-200">View</a>
                                            <a href="{{ route('orders.edit', $order) }}" class="bg-yellow-100 text-yellow-700 hover:bg-yellow-200 px-3 py-1 rounded-lg text-sm font-medium transition duration-200">Edit</a>
                                            @auth
                                                @if(auth()->user()->role === 'admin')
                                                    <form action="{{ route('orders.destroy', $order) }}" method="POST" style="display:inline;">
                                                        @csrf @method('DELETE')
                                                        <button type="submit" onclick="return confirm('Are you sure?')" class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1 rounded-lg text-sm font-medium transition duration-200">Delete</button>
                                                    </form>
                                                @endif
                                            @endauth
                                        </div>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $orders->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <div class="text-gray-400 text-6xl mb-4">📭</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Orders Found</h3>
                    <p class="text-gray-600 mb-6">{{ request('status') ? 'No orders match your filter.' : 'You haven\'t created any orders yet. Start by creating your first order!' }}</p>
                    <a href="{{ route('orders.create') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg transition duration-200">+ Create First Order</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
