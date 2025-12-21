<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900">Assign Role</h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900">Assign Role to {{ $user->name }}</h3>
                    <p class="text-gray-600 text-sm mt-1">Choose a role for this user</p>
                </div>

                <!-- Form Content -->
                <form method="POST" action="{{ route('users.update', $user) }}" class="p-8">
                    @csrf @method('PATCH')

                    <!-- Name Field (Read Only) -->
                    <div class="mb-6">
                        <label for="name" class="block text-gray-900 font-bold text-sm mb-2">Name</label>
                        <input type="text" id="name" value="{{ $user->name }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-600" 
                               disabled>
                    </div>

                    <!-- Email Field (Read Only) -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-900 font-bold text-sm mb-2">Email</label>
                        <input type="email" id="email" value="{{ $user->email }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg bg-gray-50 text-gray-600" 
                               disabled>
                    </div>

                    <!-- Role Selection -->
                    <div class="mb-8">
                        <label class="block text-gray-900 font-bold text-sm mb-4">Select Role <span class="text-red-500">*</span></label>
                        
                        <div class="space-y-4">
                            <!-- Admin Option -->
                            <label class="relative flex items-start p-4 border-2 rounded-lg cursor-pointer transition {{ $user->role === 'admin' ? 'border-red-500 bg-red-50' : 'border-gray-200 hover:border-gray-300' }}">
                                <input type="radio" name="role" value="admin" {{ $user->role === 'admin' ? 'checked' : '' }} class="mt-1 w-4 h-4 text-red-600 cursor-pointer">
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-gray-900">🔐 Administrator</p>
                                    <p class="text-sm text-gray-600 mt-1">Full access to all features including user management, customer/order deletion, and system analytics</p>
                                    <div class="mt-3 text-xs text-gray-700 space-y-1">
                                        <p><span class="font-semibold">Permissions:</span> Create, Read, Update, Delete all data + User Management</p>
                                    </div>
                                </div>
                            </label>

                            <!-- Staff Option -->
                            <label class="relative flex items-start p-4 border-2 rounded-lg cursor-pointer transition {{ $user->role === 'staff' ? 'border-blue-500 bg-blue-50' : 'border-gray-200 hover:border-gray-300' }}">
                                <input type="radio" name="role" value="staff" {{ $user->role === 'staff' ? 'checked' : '' }} class="mt-1 w-4 h-4 text-blue-600 cursor-pointer">
                                <div class="ml-4 flex-1">
                                    <p class="font-bold text-gray-900">👤 Staff Member</p>
                                    <p class="text-sm text-gray-600 mt-1">Limited access - can create and edit customers/orders but cannot delete data or manage users</p>
                                    <div class="mt-3 text-xs text-gray-700 space-y-1">
                                        <p><span class="font-semibold">Permissions:</span> Create & Read & Update only (no Delete, no User Mgmt)</p>
                                    </div>
                                </div>
                            </label>
                        </div>

                        @error('role')<span class="text-red-500 text-sm mt-2 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-3 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition duration-200 text-lg">
                            ✓ Assign Role
                        </button>
                        <a href="{{ route('users.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-900 font-bold py-3 rounded-lg transition duration-200 text-center text-lg">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>
</x-app-layout>
