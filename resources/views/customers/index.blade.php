<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900">Customers</h2>
            <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ $customers->total() }} total</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header with Action Button -->
            <div class="mb-8 flex justify-between items-center">
                <h1 class="text-2xl font-bold text-gray-900">Customer Management</h1>
                <a href="{{ route('customers.create') }}" class="bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg shadow-lg transition duration-200 inline-flex items-center gap-2">
                    <span>+</span> Add New Customer
                </a>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg">
                    <p class="text-green-700 font-medium">✓ {{ session('success') }}</p>
                </div>
            @endif

            <!-- Search & Export Section -->
            <div class="bg-white rounded-xl shadow-md p-6 mb-8">
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <form method="GET" class="md:col-span-2 flex gap-2">
                        <input type="text" name="search" value="{{ request('search') }}" placeholder="🔍 Search by name or email..." class="flex-1 px-4 py-2 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500">
                        <button type="submit" class="bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition duration-200 font-medium">Search</button>
                        <a href="{{ route('customers.index') }}" class="bg-gray-300 hover:bg-gray-400 text-gray-800 px-6 py-2 rounded-lg transition duration-200 font-medium">Clear</a>
                    </form>

                    <!-- Export Buttons -->
                    <div class="flex gap-2 justify-end">
                        <a href="{{ route('export.customers.csv') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded-lg transition duration-200 font-medium text-sm">⬇ CSV</a>
                        <a href="{{ route('export.customers.pdf') }}" class="bg-red-500 hover:bg-red-600 text-white px-4 py-2 rounded-lg transition duration-200 font-medium text-sm">⬇ PDF</a>
                    </div>
                </div>
            </div>

            <!-- Customers Grid/List -->
            @if($customers->count() > 0)
                <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
                    @foreach($customers as $customer)
                        <div class="bg-white rounded-xl shadow-md hover:shadow-xl transition duration-300 overflow-hidden border border-gray-100">
                            <!-- Card Header -->
                            <div class="bg-gradient-to-r from-green-50 to-blue-50 px-6 py-4 border-b border-gray-200">
                                <div class="flex items-start justify-between">
                                    <div class="flex items-center gap-3">
                                        @if($customer->profile_image)
                                            <img src="{{ asset('storage/profile_images/' . $customer->profile_image) }}" alt="{{ $customer->name }}" class="w-12 h-12 rounded-full object-cover border-2 border-green-500">
                                        @else
                                            <div class="w-12 h-12 rounded-full bg-gradient-to-br from-green-400 to-blue-600 flex items-center justify-center text-white font-bold text-lg">
                                                {{ substr($customer->name, 0, 1) }}
                                            </div>
                                        @endif
                                        <div>
                                            <h3 class="font-bold text-gray-900 text-lg">{{ $customer->name }}</h3>
                                            <p class="text-sm text-gray-500">{{ $customer->email }}</p>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Body -->
                            <div class="px-6 py-4">
                                <div class="space-y-3">
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase">Phone</p>
                                        <p class="text-gray-900 font-medium">{{ $customer->phone ?? 'N/A' }}</p>
                                    </div>
                                    <div>
                                        <p class="text-xs font-semibold text-gray-500 uppercase">Address</p>
                                        <p class="text-gray-700 text-sm line-clamp-2">{{ $customer->address ?? 'N/A' }}</p>
                                    </div>
                                </div>
                            </div>

                            <!-- Card Footer Actions -->
                            <div class="px-6 py-4 bg-gray-50 border-t border-gray-200 flex gap-2">
                                <a href="{{ route('customers.show', $customer) }}" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white px-3 py-2 rounded-lg transition duration-200 font-medium text-sm text-center">View</a>
                                <a href="{{ route('customers.edit', $customer) }}" class="flex-1 bg-yellow-500 hover:bg-yellow-600 text-white px-3 py-2 rounded-lg transition duration-200 font-medium text-sm text-center">Edit</a>
                                <form action="{{ route('customers.destroy', $customer) }}" method="POST" class="flex-1">
                                    @csrf @method('DELETE')
                                    <button type="submit" onclick="return confirm('Are you sure?')" class="w-full bg-red-500 hover:bg-red-600 text-white px-3 py-2 rounded-lg transition duration-200 font-medium text-sm">Delete</button>
                                </form>
                            </div>
                        </div>
                    @endforeach
                </div>

                <!-- Pagination -->
                <div class="mt-8">
                    {{ $customers->links() }}
                </div>
            @else
                <!-- Empty State -->
                <div class="bg-white rounded-xl shadow-md p-12 text-center">
                    <div class="text-gray-400 text-6xl mb-4">📭</div>
                    <h3 class="text-2xl font-bold text-gray-900 mb-2">No Customers Found</h3>
                    <p class="text-gray-600 mb-6">{{ request('search') ? 'No customers match your search.' : 'You haven\'t added any customers yet. Get started by adding your first customer!' }}</p>
                    <a href="{{ route('customers.create') }}" class="inline-block bg-green-500 hover:bg-green-600 text-white font-bold px-6 py-3 rounded-lg transition duration-200">+ Add First Customer</a>
                </div>
            @endif
        </div>
    </div>
</x-app-layout>
