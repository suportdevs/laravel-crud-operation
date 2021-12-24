<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Brands') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Total Brands <span class="px-1 rounded-md bg-indigo-500 text-white">{{ count($brands) }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-10 bg-white shadow-md text-gray-700">
        <div class="flex justify-between py-8">
            <div>
                <a href="{{ route('dashboard') }}" class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard >') }}
                </a>
                <a class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Brands') }}
                </a>
            </div>
            <div>
                <a href="{{ route('add.brand') }}" class="bg-indigo-500 px-3 py-2 rounded-md text-white hover:bg-indigo-600 focus:ring focus:ring-indigo-300 ..."><i class="fa fa-plus"></i></a>
                <a id="menuBtn" class="relative cursor-pointer bg-gray-300 px-3 py-2 rounded-md text-gray-700 focus:ring focus:ring-indigo-300 ..."><i class="fa fa-align-center"></i></a>
                <div id="trashDropdown" class="bg-white p-2 shadow-xl absolute border mt-5 hidden flex flex-col rounded">
                    <a href="{{ url('/brand/trash/list/') }}" class="p-2 text-sm hover:bg-indigo-200 sm:text-none"><i class="fa fa-list"><span class="pl-2">Trash List</span></i></a>
                    <a href="" class="p-2 text-sm hover:bg-indigo-200 sm:text-none"><i class="fa fa-trash-alt"><span class="pl-2">Trash All</span></i></a>
                    <a href="" class="p-2 text-sm hover:bg-indigo-200 sm:text-none"><i class="fa fa-recycle"><span class="pl-2">Restore All</span></i></a>
                </div>
            </div>
        </div>
        @if(session('status'))
            <span class="text-green-700 block rounded-md mb-4 bg-green-300 w-full py-3 px-5">{{ session('status') }}</span>
        @endif
        <div class="bg-white overflow-hidden sm:rounded-lg">
            <table class="w-full border text-left">
                <thead>
                    <tr class="border-t-2 border-b-2 bg-indigo-100 border-indigo-500 ...">
                        <th class="p-3 sm:p-2">#</th>
                        <th class="p-3 sm:p-2">Brand Name</th>
                        <th class="p-3 sm:p-2">Image</th>
                        <th class="p-3 sm:p-2">Author</th>
                        <th class="p-3 sm:p-2">Created At</th>
                        <th class="p-3 sm:p-2">Updated At</th>
                        <th class="p-3 sm:p-2">Action</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($brands as $data)
                    <tr class="border-y border-indigo-500 ...">
                        <td  class="p-3">{{ $brands->firstItem()+$loop->index }}</td>
                        <td  class="p-3">{{ $data->brand_name }}</td>
                        <td  class="p-3"><img src="{{ asset($data->brand_img) }}" class="w-20 h-auto" alt=""></td>
                        <td  class="p-3">{{ $data->user->name }}</td>
                        <td  class="p-3">
                            @if($data->created_at == NULL)
                                <span class="text-red-700"></span>
                            @else
                                {{ Carbon\Carbon::parse($data->created_at)->diffForHumans() }}
                            @endif
                        </td>
                        <td  class="p-3">
                            @if($data->updated_at == NULL)
                                <span class="text-red-700">Data not set</span>
                            @else
                                {{ Carbon\Carbon::parse($data->updated_at)->diffForHumans() }}
                            @endif
                        </td>
                        <td>
                            <a href="{{ url('/edit/brand/'.$data->id) }}" class="bg-blue-600 py-1 px-2 text-white rounded-md hover:bg-blue-700 focus:ring focus:ring-blue-300"><i class="fa fa-wrench"></i></a>
                            <a href="{{ url('/delete/brand/'.$data->id) }}" class="bg-red-600 py-1 px-2 text-white rounded-md hover:bg-red-700 focus:ring focus:ring-red-300"><i class="fa fa-trash-alt"></i></a>
                        </td>
                    </tr>
                    @endforeach
                    
                </tbody>
                <tfoot>
                
                </tfoot>
            </table>
        </div>
            <div class="block justify-between mx-auto py-6">
                {{ $brands->links() }}
            </div>
    </div>

    <script>
        window.addEventListener('DOMContentLoaded', () => {
            const menuBtn = document.querySelector("#menuBtn");
            const dropdown = document.querySelector("#trashDropdown");
            menuBtn.addEventListener('click', () => {
                dropdown.classList.toggle('hidden');
                dropdown.classList.toggle('');
            })
        })
    </script>
</x-app-layout>
