<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Category') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Total Category <span class="px-1 rounded-md bg-red-600"></span>
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white mt-10 pb-3 text-gray-700">
        <div class="flex justify-between py-8">
            <div>
                <a href="{{ route('dashboard') }}" class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard >') }}
                </a>
                <a href="{{ route('all.category') }}" class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Category >') }}
                </a>
                <a href="{{ route('all.category') }}" class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Add') }}
                </a>
            </div>
            <div>
                <a href="{{ route('all.category') }}" class="bg-indigo-500 px-2 py-2 rounded-md text-white hover:bg-indigo-600 focus:ring focus:ring-indigo-300 ...">List</a>
            </div>
        </div>
        <div class="flex justify-center">
            
            <form action="{{ route('store.category') }}" method="POST">
                @csrf
                <!-- <x-jet-validation-errors class="mb-4" /> -->
                @error('category_name')
                    <span class="text-red-700">{{ $message }}</span>
                @enderror
                <div>
                    <label for="name">Name</label>
                    <input type="text" name="category_name" id="name" class="w-full py-2 border-gray-400 focus:outline-none focus:ring focus:ring-violet-300" placeholder="Category Name...">
                </div>
                <div class="mt-5">
                    <label for="description">Description</label>
                    <textarea name="description" id="description" cols="30" rows="3" class="w-full border-gray-400 focus:outline-none focus:ring focus:ring-violet-300" placeholder="Description..."></textarea>
                </div>
                <button name="submit" class="bg-indigo-500 px-4 py-2 rounded-md text-white focus:outline-none focus:ring focus:ring-violet-300 ...">Summit</button>
            </form>
        </div>
    </div>
            
</x-app-layout>
