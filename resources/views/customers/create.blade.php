<x-app-layout>
    <x-slot name="header">
        <h2 class="font-bold text-3xl text-gray-900">Add New Customer</h2>
    </x-slot>

    <div class="py-12 bg-gray-50 min-h-screen">
        <div class="max-w-2xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white rounded-xl shadow-md overflow-hidden">
                <!-- Form Header -->
                <div class="bg-gradient-to-r from-green-50 to-blue-50 px-8 py-6 border-b border-gray-200">
                    <h3 class="text-xl font-bold text-gray-900">Customer Details</h3>
                    <p class="text-gray-600 text-sm mt-1">Fill in the information below to create a new customer</p>
                </div>

                <!-- Form Content -->
                <form method="POST" action="{{ route('customers.store') }}" enctype="multipart/form-data" class="p-8">
                    @csrf

                    <!-- Name Field -->
                    <div class="mb-6">
                        <label for="name" class="block text-gray-900 font-bold text-sm mb-2">Full Name <span class="text-red-500">*</span></label>
                        <input type="text" id="name" name="name" value="{{ old('name') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('name') border-red-500 @enderror" 
                               placeholder="Enter customer name" required>
                        @error('name')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Email Field -->
                    <div class="mb-6">
                        <label for="email" class="block text-gray-900 font-bold text-sm mb-2">Email Address <span class="text-red-500">*</span></label>
                        <input type="email" id="email" name="email" value="{{ old('email') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('email') border-red-500 @enderror" 
                               placeholder="customer@example.com" required>
                        @error('email')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Phone Field -->
                    <div class="mb-6">
                        <label for="phone" class="block text-gray-900 font-bold text-sm mb-2">Phone Number</label>
                        <input type="tel" id="phone" name="phone" value="{{ old('phone') }}" 
                               class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('phone') border-red-500 @enderror" 
                               placeholder="+1 (555) 000-0000">
                        @error('phone')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Address Field -->
                    <div class="mb-6">
                        <label for="address" class="block text-gray-900 font-bold text-sm mb-2">Address</label>
                        <textarea id="address" name="address" 
                                  class="w-full px-4 py-3 border border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-green-500 focus:border-transparent @error('address') border-red-500 @enderror" 
                                  rows="4" placeholder="Enter customer address">{{ old('address') }}</textarea>
                        @error('address')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Profile Image Field -->
                    <div class="mb-6">
                        <label for="profile_image" class="block text-gray-900 font-bold text-sm mb-2">Profile Image</label>
                        <div class="border-2 border-dashed border-gray-300 rounded-lg p-6 text-center hover:border-green-400 transition duration-200 cursor-pointer" id="dropzone">
                            <input type="file" id="profile_image" name="profile_image" accept="image/*" 
                                   class="hidden @error('profile_image') border-red-500 @enderror">
                            <div class="text-gray-500">
                                <div class="text-3xl mb-2">🖼️</div>
                                <p class="font-medium">Drag and drop your image here</p>
                                <p class="text-sm text-gray-400">or click to select a file</p>
                                <p class="text-xs text-gray-400 mt-2">PNG, JPG, GIF up to 5MB</p>
                            </div>
                        </div>
                        @error('profile_image')<span class="text-red-500 text-sm mt-1 block">{{ $message }}</span>@enderror
                    </div>

                    <!-- Form Actions -->
                    <div class="flex gap-3 pt-6 border-t border-gray-200">
                        <button type="submit" class="flex-1 bg-green-500 hover:bg-green-600 text-white font-bold py-3 rounded-lg transition duration-200 text-lg">
                            ✓ Save Customer
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
            dropzone.classList.add('border-green-400', 'bg-green-50');
        });

        dropzone.addEventListener('dragleave', () => {
            dropzone.classList.remove('border-green-400', 'bg-green-50');
        });

        dropzone.addEventListener('drop', (e) => {
            e.preventDefault();
            dropzone.classList.remove('border-green-400', 'bg-green-50');
            fileInput.files = e.dataTransfer.files;
        });
    </script>
</x-app-layout>
