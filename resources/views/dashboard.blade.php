<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900">Dashboard</h2>
            <div class="text-sm text-gray-500">{{ now()->format('l, F j, Y') }}</div>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-green-500 to-green-600 text-white p-8 rounded-xl shadow-lg mb-8">
                <h3 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-green-100">Here's your business overview at a glance</p>
            </div>

            <!-- Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Customers Card -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Total Customers</p>
                            <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalCustomers }}</p>
                            <p class="text-xs text-gray-400 mt-2">Active in system</p>
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
                            <p class="text-xs text-gray-400 mt-2">Completed & pending</p>
                        </div>
                        <div class="text-green-100 text-5xl">📦</div>
                    </div>
                </div>

                <!-- Total Revenue Card -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 border-l-4 border-purple-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Total Revenue</p>
                            <p class="text-4xl font-bold text-purple-600 mt-2">${{ number_format($totalRevenue ?? 0, 0) }}</p>
                            <p class="text-xs text-gray-400 mt-2">All time earnings</p>
                        </div>
                        <div class="text-purple-100 text-5xl">💰</div>
                    </div>
                </div>

                <!-- Average Order Value Card -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 border-l-4 border-orange-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Avg Order Value</p>
                            <p class="text-4xl font-bold text-orange-600 mt-2">{{ $totalOrders > 0 ? '$' . number_format(($totalRevenue ?? 0) / $totalOrders, 0) : '$0' }}</p>
                            <p class="text-xs text-gray-400 mt-2">Per transaction</p>
                        </div>
                        <div class="text-orange-100 text-5xl">📊</div>
                    </div>
                </div>
            </div>

            <!-- Recent Customers Section -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                    <div class="flex justify-between items-center">
                        <h3 class="text-2xl font-bold text-gray-900">Recent Customers</h3>
                        <a href="{{ route('customers.index') }}" class="bg-green-500 hover:bg-green-600 text-white px-4 py-2 rounded-lg transition duration-200 text-sm font-medium">View All</a>
                    </div>
                </div>
                
                @if($recentCustomers->count() > 0)
                    <div class="overflow-x-auto">
                        <table class="w-full">
                            <thead class="bg-gray-50">
                                <tr class="border-b border-gray-200">
                                    <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                                    <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                                    <th class="px-8 py-4 text-left text-sm font-semibold text-gray-700">Phone</th>
                                    <th class="px-8 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($recentCustomers as $customer)
                                    <tr class="border-b border-gray-100 hover:bg-gray-50 transition duration-200">
                                        <td class="px-8 py-4">
                                            <div class="flex items-center gap-3">
                                                <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                                                    {{ substr($customer->name, 0, 1) }}
                                                </div>
                                                <span class="font-medium text-gray-900">{{ $customer->name }}</span>
                                            </div>
                                        </td>
                                        <td class="px-8 py-4 text-gray-600">{{ $customer->email }}</td>
                                        <td class="px-8 py-4 text-gray-600">{{ $customer->phone ?? 'N/A' }}</td>
                                        <td class="px-8 py-4 text-center">
                                            <a href="{{ route('customers.show', $customer) }}" class="inline-flex items-center gap-1 bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-lg text-sm font-medium transition duration-200">
                                                View →
                                            </a>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                @else
                    <div class="px-8 py-12 text-center">
                        <div class="text-gray-400 text-5xl mb-4">📭</div>
                        <p class="text-gray-600 font-medium">No customers yet</p>
                        <p class="text-gray-400 text-sm mt-1">Create your first customer to get started</p>
                        <a href="{{ route('customers.create') }}" class="inline-block mt-4 bg-green-500 hover:bg-green-600 text-white px-6 py-2 rounded-lg transition duration-200 font-medium">Create Customer</a>
                    </div>
                @endif
            </div>
        </div>
    </div>
</x-app-layout>
