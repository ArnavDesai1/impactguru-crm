<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900">Admin Dashboard</h2>
            <span class="text-sm text-white bg-red-600 px-3 py-1 rounded-full font-semibold">Administrator</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Welcome Section -->
            <div class="bg-gradient-to-r from-red-600 to-pink-600 text-white p-8 rounded-xl shadow-lg mb-8">
                <h3 class="text-2xl font-bold mb-2">Welcome back, {{ auth()->user()->name }}! 👋</h3>
                <p class="text-red-100">You have full access to all system features and analytics</p>
            </div>

            <!-- Main Statistics Cards -->
            <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-6 mb-8">
                <!-- Total Customers Card -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 border-l-4 border-blue-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Total Customers</p>
                            <p class="text-4xl font-bold text-blue-600 mt-2">{{ $totalCustomers }}</p>
                            <p class="text-xs text-gray-400 mt-2">All registered customers</p>
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
                            <p class="text-xs text-gray-400 mt-2">All time orders</p>
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
                            <p class="text-xs text-gray-400 mt-2">Complete earnings</p>
                        </div>
                        <div class="text-purple-100 text-5xl">💰</div>
                    </div>
                </div>

                <!-- Total Users Card -->
                <div class="bg-white p-6 rounded-xl shadow-md hover:shadow-lg transition duration-300 border-l-4 border-orange-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Total Users</p>
                            <p class="text-4xl font-bold text-orange-600 mt-2">{{ $totalUsers }}</p>
                            <p class="text-xs text-gray-400 mt-2">System users</p>
                        </div>
                        <div class="text-orange-100 text-5xl">🔐</div>
                    </div>
                </div>
            </div>

            <!-- Order Status Overview -->
            <div class="grid grid-cols-1 md:grid-cols-2 gap-6 mb-8">
                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-yellow-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Pending Orders</p>
                            <p class="text-4xl font-bold text-yellow-600 mt-2">{{ $pendingOrders }}</p>
                            <p class="text-xs text-gray-400 mt-2">Awaiting completion</p>
                        </div>
                        <div class="text-yellow-100 text-5xl">⏳</div>
                    </div>
                </div>

                <div class="bg-white rounded-xl shadow-md p-6 border-l-4 border-green-500">
                    <div class="flex items-center justify-between">
                        <div>
                            <p class="text-gray-600 text-sm font-medium uppercase tracking-wide">Completed Orders</p>
                            <p class="text-4xl font-bold text-green-600 mt-2">{{ $completedOrders }}</p>
                            <p class="text-xs text-gray-400 mt-2">Successfully finished</p>
                        </div>
                        <div class="text-green-100 text-5xl">✓</div>
                    </div>
                </div>
            </div>

            <div class="grid grid-cols-1 lg:grid-cols-2 gap-8">
                <!-- Recent Customers Section -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-900">Recent Customers</h3>
                            <a href="{{ route('customers.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All →</a>
                        </div>
                    </div>
                    
                    @if($recentCustomers->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <tbody>
                                    @foreach($recentCustomers as $customer)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                                                        {{ substr($customer->name, 0, 1) }}
                                                    </div>
                                                    <div>
                                                        <p class="font-medium text-gray-900">{{ $customer->name }}</p>
                                                        <p class="text-xs text-gray-500">{{ $customer->email }}</p>
                                                    </div>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <a href="{{ route('customers.show', $customer) }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View</a>
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

                <!-- Recent Orders Section -->
                <div class="bg-white rounded-xl shadow-md overflow-hidden">
                    <div class="px-8 py-6 border-b border-gray-200 bg-gradient-to-r from-gray-50 to-white">
                        <div class="flex justify-between items-center">
                            <h3 class="text-xl font-bold text-gray-900">Recent Orders</h3>
                            <a href="{{ route('orders.index') }}" class="text-blue-600 hover:text-blue-700 text-sm font-medium">View All →</a>
                        </div>
                    </div>
                    
                    @if($recentOrders->count() > 0)
                        <div class="overflow-x-auto">
                            <table class="w-full">
                                <tbody>
                                    @foreach($recentOrders as $order)
                                        <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                            <td class="px-6 py-4">
                                                <div class="flex items-center gap-3">
                                                    <span class="font-bold text-gray-900 bg-gray-100 px-2 py-1 rounded text-sm">{{ $order->order_number }}</span>
                                                    <span class="text-gray-700 text-sm">{{ $order->customer->name }}</span>
                                                </div>
                                            </td>
                                            <td class="px-6 py-4 text-right">
                                                <span class="text-gray-900 font-bold text-sm">${{ number_format($order->amount, 2) }}</span>
                                                <br>
                                                @if($order->status === 'Completed')
                                                    <span class="inline-block bg-green-100 text-green-800 text-xs px-2 py-1 rounded mt-1">✓ Completed</span>
                                                @elseif($order->status === 'Pending')
                                                    <span class="inline-block bg-yellow-100 text-yellow-800 text-xs px-2 py-1 rounded mt-1">⏳ Pending</span>
                                                @else
                                                    <span class="inline-block bg-red-100 text-red-800 text-xs px-2 py-1 rounded mt-1">✗ Cancelled</span>
                                                @endif
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    @else
                        <div class="px-8 py-8 text-center text-gray-500">
                            No orders yet
                        </div>
                    @endif
                </div>
            </div>

            <!-- Admin Actions -->
            <div class="mt-8 bg-white rounded-xl shadow-md p-8">
                <h3 class="text-xl font-bold text-gray-900 mb-6">Admin Actions</h3>
                <div class="grid grid-cols-1 md:grid-cols-3 gap-4">
                    <a href="{{ route('customers.create') }}" class="bg-blue-500 hover:bg-blue-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium text-center">
                        + Add Customer
                    </a>
                    <a href="{{ route('orders.create') }}" class="bg-green-500 hover:bg-green-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium text-center">
                        + Add Order
                    </a>
                    <a href="{{ route('customers.index') }}" class="bg-purple-500 hover:bg-purple-600 text-white px-6 py-3 rounded-lg transition duration-200 font-medium text-center">
                        📊 View Analytics
                    </a>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
