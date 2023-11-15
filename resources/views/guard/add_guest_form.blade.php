<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Add Guest Form') }}
        </h2>
    </x-slot>
    
<div class="bg-gray-100 p-8">
    <div class="max-w-md mx-auto bg-white p-4 rounded-md shadow-md">
        <h1 class="text-2xl font-semibold mb-4">Add Guest</h1>

        <!-- Guest Form -->
        <form action="{{ route('guard.store_guest') }}" method="post">
            @csrf

            <div class="mb-4">
                <label for="name" class="block text-sm font-medium text-gray-600">Name</label>
                <input type="text" id="name" name="name" class="mt-1 p-2 w-full border rounded-md">
                @error('name')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="email" class="block text-sm font-medium text-gray-600">Email</label>
                <input type="email" id="email" name="email" class="mt-1 p-2 w-full border rounded-md">
                @error('email')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mb-4">
                <label for="phone" class="block text-sm font-medium text-gray-600">Phone</label>
                <input type="text" id="phone" name="phone" class="mt-1 p-2 w-full border rounded-md">
                @error('phone')
                    <p class="text-red-500 text-xs mt-1">{{ $message }}</p>
                @enderror
            </div>

            <div class="mt-4">
                <button type="submit" class="bg-blue-300 hover:bg-blue-200 text-black py-2 px-4 rounded">
                    Add 
                </button>
            </div>
        </form>
    </div>

<x-app-layout>
