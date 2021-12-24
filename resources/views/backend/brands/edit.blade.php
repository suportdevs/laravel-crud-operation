<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Brand') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Total Brand <span class="px-1 rounded-md bg-red-600"></span>
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white mt-10 pb-3 text-gray-700">
        <div class="flex justify-between py-8">
            <div>
                <a href="{{ route('dashboard') }}" class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard >') }}
                </a>
                <a href="{{ route('all.brands') }}" class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Brand >') }}
                </a>
                <a href="{{ route('all.brands') }}" class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Edit') }}
                </a>
            </div>
            <div>
                <a href="{{ route('all.brands') }}" class="bg-indigo-500 px-2 py-2 rounded-md text-white hover:bg-indigo-600 focus:ring focus:ring-indigo-300 ..."><i class="fa fa-list-ul"></i> List</a>
            </div>
        </div>
        <div class="flex justify-evenly gap-10">
            
            <div class="w-90 flex">
                <form action="{{ url('/update/brand/'.$brand->id) }}" method="POST" class="w-3/1" enctype="multipart/form-data">
                    @csrf
                    <x-jet-validation-errors class="mb-4 text-red-700" />
                    <div>
                        <label for="name">Name</label>
                        <input type="text" name="brand_name" id="name" class="w-full mt-2 py-2 border-gray-400 focus:outline-none focus:ring focus:ring-violet-300" value="{{ $brand->brand_name }}">
                    </div>
                    <div class="my-4">
                        <label for="name">Image</label>
                        <input type="file" name="brand_img" id="name" class="block w-full mt-2 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100  focus:ring focus:ring-violet-300" value="{{ $brand->brand_img }}"/>
                    </div>
                    <div class="mt-5">
                        <label for="description">Description</label>
                        <textarea name="description" id="description" cols="30" rows="3" class="w-full mt-2 mb-4 border-gray-400 focus:outline-none focus:ring focus:ring-violet-300" value="{{ $brand->description }}">{{ $brand->description }}</textarea>
                    </div>
                    <button name="submit" class="bg-indigo-500 px-4 py-2 rounded-md text-white hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-violet-300 ...">Update</button>
                </form>
            </div>
            <div class="w-80 text-center justify-center">
                <h1 class="text-2xl mb-5">Brand Image</h1>
                <img src="{{ asset($brand->brand_img) }}" class="w-70 h-42" >
            </div>
        </div>
    </div>
            
</x-app-layout>
