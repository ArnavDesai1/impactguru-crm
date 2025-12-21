<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900">Dashboard</h2>
            <span class="text-sm text-white bg-blue-600 px-3 py-1 rounded-full font-semibold">Staff Member</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-blue-500 to-cyan-600 text-white p-8 rounded-xl shadow-lg mb-8">
                <h3 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-blue-100">Your daily task overview and quick access to customer and order management</p>
            </div>

            <!-- Main Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6 mb-8">
                <!-- Total Customers Card -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Total Customers</p>
                            <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalCustomers }}</p>
                            <p class="text-xs text-gray-400 mt-2">In the system</p>
                        </div>
                        <div class="text-blue-100 text-5xl">👥</div>
                    </div>
                </div>

                <!-- Total Orders Card -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Total Orders</p>
                            <p class="text-4xl font-bold text-green-600 mt-2">{{ $totalOrders }}</p>
                            <p class="text-xs text-gray-400 mt-2">To manage</p>
                        </div>
                        <div class="text-green-100 text-5xl">📦</div>
                    </div>
                </div>

                <!-- Pending Orders Card -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Pending Orders</p>
                            <p class="text-4xl font-bold text-yellow-600 mt-2">{{ $pendingOrders }}</p>
                            <p class="text-xs text-gray-400 mt-2">Need attention</p>
                        </div>
                        <div class="text-yellow-100 text-5xl">⏳</div>
                    </div>
                </div>
            </div>

            <!-- Recent Customers Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden mb-8">
                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-xl font-bold text-gray-900">Recent Customers</h3>
                        <a href="{{ route('customers.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All →</a>
                    </div>
                </div>
                
                @if($recentCustomers->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Customer</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                                    <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Phone</th>
                                    <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Action</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentCustomers as $customer)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                        <td class="px-6 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                                                    {{ substr($customer->name, 0, 1) }}
                                                </div>
                                                <span class="font-medium text-gray-900">{{ $customer->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-6 py-4 text-gray-600">{{ $customer->email }}</td>
                                        <td class="px-6 py-4 text-gray-600">{{ $customer->phone ?? 'N/A' }}</td>
                                        <td class="px-6 py-4 text-center">
                                            <a href="{{ route('customers.show', $customer) }}" class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-lg text-sm font-medium transition">
                                                View
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-8 py-8 text-center text-gray-500">
                        No customers yet
                    </div>
                @endif
            </div>

            <!-- Quick Actions -->
            <div class="bg-white rounded-xl shadow-md p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Quick Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-2 gap-4">
                    <a href="{{ route('customers.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium text-center">
                        + Add New Customer
                    </a>
                    <a href="{{ route('orders.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium text-center">
                        + Create New Order
                    </a>
                </div>
            </div>

            <!-- Permissions Info -->
            <div class="mt-8 bg-blue-50 border-l-4 border-blue-500 p-6 rounded-lg">
                <p class="text-blue-900 font-medium">📋 Your Permissions</p>
                <ul class="text-blue-800 text-sm mt-3 space-y-1">
                    <li>✓ View, create, edit customers and orders</li>
                    <li>✓ Search and filter customer and order data</li>
                    <li>✓ Export customer and order data to CSV/PDF</li>
                    <li>✗ Cannot delete customers or orders (Admin only)</li>
                    <li>✗ Cannot manage user accounts (Admin only)</li>
                </ul>
            </div>
        </div>
    </div>
</x-app-layout>
