<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between items-center">
            <h2 class="font-bold text-3xl text-gray-900">User Management</h2>
            <span class="text-sm text-gray-500 bg-gray-100 px-3 py-1 rounded-full">{{ $users->total() }} users</span>
        </div>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <!-- Header -->
            <div class="mb-8">
                <h1 class="text-2xl font-bold text-gray-900">Manage Users & Assign Roles</h1>
                <p class="text-gray-600 mt-2">Assign admin or staff roles to users</p>
            </div>

            @if(session('success'))
                <div class="bg-green-50 border-l-4 border-green-500 p-4 mb-6 rounded-lg">
                    <p class="text-green-700 font-medium">✓ {{ session('success') }}</p>
                </div>
            @endif

            @if(session('error'))
                <div class="bg-red-50 border-l-4 border-red-500 p-4 mb-6 rounded-lg">
                    <p class="text-red-700 font-medium">✗ {{ session('error') }}</p>
                </div>
            @endif

            <!-- Users Table -->
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <table class="w-full">
                    <thead class="bg-gray-50 border-b border-gray-200">
                        <tr>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Name</th>
                            <th class="px-6 py-4 text-left text-sm font-semibold text-gray-700">Email</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Current Role</th>
                            <th class="px-6 py-4 text-center text-sm font-semibold text-gray-700">Actions</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach($users as $user)
                            <tr class="border-b border-gray-100 hover:bg-gray-50 transition">
                                <td class="px-6 py-4">
                                    <div class="flex items-center gap-3">
                                        <div class="w-10 h-10 rounded-full bg-gradient-to-br from-blue-400 to-blue-600 flex items-center justify-center text-white font-bold">
                                            {{ substr($user->name, 0, 1) }}
                                        </div>
                                        <div>
                                            <p class="font-medium text-gray-900">{{ $user->name }}</p>
                                            @if(auth()->id() === $user->id)
                                                <span class="text-xs text-blue-600 font-semibold">(You)</span>
                                            @endif
                                        </div>
                                    </div>
                                </td>
                                <td class="px-6 py-4 text-gray-600">{{ $user->email }}</td>
                                <td class="px-6 py-4 text-center">
                                    @if($user->role === 'admin')
                                        <span class="inline-flex items-center gap-1 bg-red-100 text-red-800 px-3 py-1 rounded-full text-sm font-semibold">🔐 Admin</span>
                                    @else
                                        <span class="inline-flex items-center gap-1 bg-blue-100 text-blue-800 px-3 py-1 rounded-full text-sm font-semibold">👤 Staff</span>
                                    @endif
                                </td>
                                <td class="px-6 py-4 text-center">
                                    <div class="flex gap-2 justify-center">
                                        @if(auth()->id() !== $user->id)
                                            <a href="{{ route('users.edit', $user) }}" class="bg-blue-100 text-blue-700 hover:bg-blue-200 px-3 py-1 rounded-lg text-sm font-medium transition duration-200">
                                                Edit Role
                                            </a>
                                            <form action="{{ route('users.destroy', $user) }}" method="POST" style="display:inline;">
                                                @csrf @method('DELETE')
                                                <button type="submit" onclick="return confirm('Are you sure you want to delete this user?')" class="bg-red-100 text-red-700 hover:bg-red-200 px-3 py-1 rounded-lg text-sm font-medium transition duration-200">
                                                    Delete
                                                </button>
                                            </form>
                                        @else
                                            <span class="text-gray-500 text-sm px-3 py-1">Cannot modify your own account</span>
                                        @endif
                                    </div>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>

            <!-- Pagination -->
            <div class="mt-8">
                {{ $users->links() }}
            </div>

            <!-- Role Information -->
            <div class="mt-12 grid grid-cols-1 md:grid-cols-2 gap-6">
                <!-- Admin Role Card -->
                <div class="bg-white rounded-xl shadow-md p-8 border-l-4 border-red-600">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">🔐 Admin Role</h3>
                    <p class="text-gray-700 font-medium mb-4">Full system access including:</p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 font-bold">✓</span>
                            <span>Manage all customers</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 font-bold">✓</span>
                            <span>Manage all orders (create, edit, delete)</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 font-bold">✓</span>
                            <span>Manage user accounts and roles</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 font-bold">✓</span>
                            <span>View all reports and analytics</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 font-bold">✓</span>
                            <span>Access admin dashboard with all stats</span>
                        </li>
                    </ul>
                </div>

                <!-- Staff Role Card -->
                <div class="bg-white rounded-xl shadow-md p-8 border-l-4 border-blue-600">
                    <h3 class="text-xl font-bold text-gray-900 mb-4">👤 Staff Role</h3>
                    <p class="text-gray-700 font-medium mb-4">Limited access including:</p>
                    <ul class="space-y-2 text-gray-600">
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 font-bold">✓</span>
                            <span>Create and edit customers</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 font-bold">✓</span>
                            <span>Create and edit orders</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-green-500 font-bold">✓</span>
                            <span>View and search data</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-500 font-bold">✗</span>
                            <span>Cannot delete customers or orders</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-500 font-bold">✗</span>
                            <span>Cannot manage user accounts</span>
                        </li>
                        <li class="flex items-start gap-2">
                            <span class="text-red-500 font-bold">✗</span>
                            <span>Limited dashboard view</span>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
