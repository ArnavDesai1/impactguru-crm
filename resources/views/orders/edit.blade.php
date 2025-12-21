<x-app-layout>
    <x-slot name="header">
        <h2 class="text-xl font-semibold">Edit Order</h2>
    </x-slot>

    <div class="p-6 max-w-2xl">
        <form method="POST" action="{{ route('orders.update', $order) }}">
            @csrf @method('PUT')

            <div class="mb-4">
                <label for="customer_id" class="block text-gray-700 font-bold mb-2">Customer *</label>
                <select id="customer_id" name="customer_id" class="w-full px-4 py-2 border rounded @error('customer_id') border-red-500 @enderror" required>
                    <option value="">Select a customer</option>
                    @foreach($customers as $customer)
                        <option value="{{ $customer->id }}" @selected(old('customer_id', $order->customer_id) == $customer->id)>{{ $customer->name }}</option>
                    @endforeach
                </select>
                @error('customer_id')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="mb-4">
                <label for="amount" class="block text-gray-700 font-bold mb-2">Amount *</label>
                <input type="number" id="amount" name="amount" value="{{ old('amount', $order->amount) }}" step="0.01" min="0" class="w-full px-4 py-2 border rounded @error('amount') border-red-500 @enderror" required>
                @error('amount')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="mb-4">
                <label for="status" class="block text-gray-700 font-bold mb-2">Status *</label>
                <select id="status" name="status" class="w-full px-4 py-2 border rounded @error('status') border-red-500 @enderror" required>
                    <option value="">Select status</option>
                    <option value="Pending" @selected(old('status', $order->status) === 'Pending')>Pending</option>
                    <option value="Completed" @selected(old('status', $order->status) === 'Completed')>Completed</option>
                    <option value="Cancelled" @selected(old('status', $order->status) === 'Cancelled')>Cancelled</option>
                </select>
                @error('status')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="mb-4">
                <label for="order_date" class="block text-gray-700 font-bold mb-2">Order Date *</label>
                <input type="date" id="order_date" name="order_date" value="{{ old('order_date', $order->order_date->format('Y-m-d')) }}" class="w-full px-4 py-2 border rounded @error('order_date') border-red-500 @enderror" required>
                @error('order_date')<span class="text-red-500 text-sm">{{ $message }}</span>@enderror
            </div>

            <div class="flex gap-2">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">Update</button>
                <a href="{{ route('orders.index') }}" class="bg-gray-500 text-white px-4 py-2 rounded hover:bg-gray-600">Cancel</a>
            </div>
        </form>
    </div>
</x-app-layout>
