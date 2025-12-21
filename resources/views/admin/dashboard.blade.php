<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            Admin Dashboard
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg p-6">
                <h3 class="text-lg font-bold">Welcome Admin 👑</h3>
                <p>Name: {{ auth()->user()->name }}</p>
                <p>Email: {{ auth()->user()->email }}</p>
                <p>Role: {{ auth()->user()->role }}</p>
            </div>
        </div>
    </div>
</x-app-layout>
