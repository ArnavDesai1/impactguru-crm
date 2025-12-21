<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900">Edit Customer</h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-blue-50 to-purple-50 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900">Update Customer Information</h3>
                    <p class="text-gray-600 text-sm mt-1">Modify the customer details below</p>
                </div>

                <!-- Form Content -->
                <form method="POST" action="{{ route('customers.update', $customer) }}" enctype="multipart/form-data" class="p-8">
                    @csrf @method('PUT')

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-gray-900 font-bold text-sm mb-2">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name', $customer->name) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                               required>
                        @error('name')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-900 font-bold text-sm mb-2">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email', $customer->email) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('email') border-red-500 @enderror" 
                               required>
                        @error('email')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Phone Field -->
                    <div class="mb-6">
                        <label for="phone" class="block text-gray-900 font-bold text-sm mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone', $customer->phone) }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('phone') border-red-500 @enderror">
                        @error('phone')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Address Field -->
                    <div class="mb-6">
                        <label for="address" class="block text-gray-900 font-bold text-sm mb-2">Address</label>
                        <textarea id="address" name="address" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500 focus:border-transparent @error('address') border-red-500 @enderror" 
                                  rows="4">{{ old('address', $customer->address) }}</textarea>
                        @error('address')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Profile Image Field -->
                    <div class="mb-6">
                        <label for="profile_image" class="block text-gray-900 font-bold text-sm mb-2">Profile Image</label>
                        @if($customer->profile_image)
                            <div class="mb-4 p-4 bg-gray-50 rounded-lg border border-gray-200">
                                <p class="text-xs text-gray-600 mb-2">Current Image:</p>
                                <img src="{{ asset('storage/profile_images/' . $customer->profile_image) }}" alt="Profile" class="h-24 w-24 object-cover rounded-lg border-2 border-blue-500">
                            </div>
                        @endif
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-blue-400 transition duration-200 cursor-pointer" id="dropzone">
                            <input type="file" id="profile_image" name="profile_image" accept="image/*" class="hidden">
                            <div class="text-gray-500">
                                <div class="text-3xl mb-2">🖼️</div>
                                <p class="font-medium">Drag and drop to replace</p>
                                <p class="text-sm text-gray-400">or click to select a new image</p>
                            </div>
                        </div>
                        @error('profile_image')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-3 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 bg-blue-500 hover:bg-blue-600 text-white font-bold py-3 rounded-lg transition duration-200 text-lg">
                            ✓ Update Customer
                        </button>
                        <a href="{{ route('customers.index') }}" class="flex-1 bg-gray-300 hover:bg-gray-400 text-gray-900 font-bold py-3 rounded-lg transition duration-200 text-center text-lg">
                            Cancel
                        </a>
                    </div>
                </form>
            </div>
        </div>
    </div>

    <script>
        const dropzone = document.getElementById('dropzone');
        const fileInput = document.getElementById('profile_image');

        dropzone.addEventListener('click', () => fileInput.click());
        
        dropzone.addEventListener('dragover', (e) => {
            e.preventDefault();
            dropzone.classList.add('border-blue-400', 'bg-blue-50');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-blue-400', 'bg-blue-50');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-blue-400', 'bg-blue-50');
            fileInput.files = e.dataTransfer.files;
        });
    </script>
</x-app-layout>
</x-app-layout>
