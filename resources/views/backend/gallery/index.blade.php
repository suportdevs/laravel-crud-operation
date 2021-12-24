<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Gallery') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Total Gallery <span class="px-1 rounded-md text-white bg-indigo-500">{{ count($gallery) }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 bg-white mt-10 pb-3 text-gray-700">
        <div class="flex justify-between py-8">
            <div>
                <a href="{{ route('dashboard') }}" class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard >') }}
                </a>
                <a class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Gallery >') }}
                </a>
            </div>
            <div>
                <a href="" class="bg-indigo-500 px-2 py-2 rounded-md text-white hover:bg-indigo-600 focus:ring focus:ring-indigo-300 ..."><i class="fa fa-list-ul"></i> List</a>
            </div>
        </div>
        <div class="flex gap-10">
            
            <div class="w-70 flex">
                <form action="{{ route('gallery.insert') }}" method="POST" class="w-3/1" enctype="multipart/form-data">
                    @csrf
                    <x-jet-validation-errors class="mb-4 text-red-700" />
                    <div class="my-4">
                        <label for="title">Title</label>
                        <input type="text" name="title" id="title" class="block w-full mt-2 mb-3   focus:ring focus:ring-violet-300" placeholder="Gallery Title..."/>
                        <label for="file">Gallery Image</label>
                        <input type="file" name="image[]" id="file" class="block w-full mt-2 cursor-pointer file:mr-4 file:py-2 file:px-4 file:rounded-full file:border-0 file:text-sm file:font-semibold file:bg-violet-50 file:text-violet-700 hover:file:bg-violet-100  focus:ring focus:ring-violet-300" multiple/>
                    </div>
                    <button name="submit" class="bg-indigo-500 px-4 py-2 rounded-md text-white hover:bg-indigo-600 focus:outline-none focus:ring focus:ring-violet-300 ...">Add Gallery</button>
                </form>
            </div>
            <div class="w-full text-center justify-center">
                <h1 class="text-2xl mb-5">Gallery Image</h1>
                <div class="flex grid grid-cols-4 gap-3">
                    @foreach($gallery as $image)
                        <div><img src="{{ asset($image->image) }}" class="w-full height-auto" alt=""></div>
                    @endforeach
                </div>
            </div>
        </div>
    </div>
            
</x-app-layout>
