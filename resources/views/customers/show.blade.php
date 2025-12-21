<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Customer Details</h2>
    </x-slot>

    <div class="p-6 max-w-2xl">
        <div class="bg-white rounded-lg shadow p-6">
            @if($customer->profile_image)
                <div class="mb-4">
                    <img src="{{ Storage::url($customer->profile_image) }}" alt="Profile" class="h-32 w-32 object-cover rounded">
                </div>
            @endif

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Name</label>
                <p class="text-gray-900">{{ $customer->name }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Email</label>
                <p class="text-gray-900">{{ $customer->email }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Phone</label>
                <p class="text-gray-900">{{ $customer->phone ?? 'N/A' }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Address</label>
                <p class="text-gray-900">{{ $customer->address ?? 'N/A' }}</p>
            </div>

            <div class="mb-4">
                <label class="block text-gray-700 font-bold mb-2">Total Orders</label>
                <p class="text-gray-900">{{ $customer->orders()->count() }}</p>
            </div>

            <div class="flex gap-2">
                <a href="{{ route('customers.edit', $customer) }}" class="bg-yellow-500 text-white px-4 py-2 rounded hover:bg-yellow-600">Edit</a>
                <a href="{{ route('customers.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Back</a>
            </div>
        </div>

        <!-- Customer's Orders -->
        @if($customer->orders->count() > 0)
            <div class="mt-6">
                <h3 class="text-lg font-semibold mb-4">Orders from this customer</h3>
                <div class="overflow-x-auto">
                    <table class="w-full border-collapse border border-gray-300">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="border px-4 py-2 text-left">Order Number</th>
                                <th class="border px-4 py-2 text-left">Amount</th>
                                <th class="border px-4 py-2 text-left">Status</th>
                                <th class="border px-4 py-2 text-left">Date</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($customer->orders as $order)
                                <tr class="hover:bg-gray-50">
                                    <td class="border px-4 py-2">{{ $order->order_number }}</td>
                                    <td class="border px-4 py-2">${{ number_format($order->amount, 2) }}</td>
                                    <td class="border px-4 py-2">
                                        <span class="px-2 py-1 rounded text-sm
                                            @if($order->status === 'Completed') bg-green-100 text-green-800
                                            @elseif($order->status === 'Pending') bg-yellow-100 text-yellow-800
                                            @else bg-red-100 text-red-800
                                            @endif">
                                            {{ $order->status }}
                                        </span>
                                    </td>
                                    <td class="border px-4 py-2">{{ $order->order_date->format('M d, Y') }}</td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        @endif
    </div>
</x-app-layout>
