<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Order Details</h2>
    </x-slot>

    <div class="p-6 max-w-2xl">
        <div class="bg-white rounded-lg shadow p-6">
            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Order Number</label>
                <p class="text-gray-900">{{ $order->order_number }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Customer</label>
                <p class="text-gray-900">
                    <a href="{{ route('customers.show', $order->customer) }}" class="text-blue-600 hover:underline">{{ $order->customer->name }}</a>
                </p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Amount</label>
                <p class="text-gray-900">${{ number_format($order->amount, 2) }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Status</label>
                <p class="text-gray-900">
                    <span class="px-2 py-1 rounded text-sm
                        @if($order->status === 'Completed') bg-green-100 text-green-800
                        @elseif($order->status === 'Pending') bg-yellow-100 text-yellow-800
                        @else bg-red-100 text-red-800
                        @endif">
                        {{ $order->status }}
                    </span>
                </p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Order Date</label>
                <p class="text-gray-900">{{ $order->order_date->format('M d, Y') }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Created</label>
                <p class="text-gray-900">{{ $order->created_at->format('M d, Y H:i A') }}</p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('orders.edit', $order) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                <a href="{{ route('orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
            </div>
        </div>
    </div>
</x-app-layout>
