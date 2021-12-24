
<x-app-layout>
    <x-slot name="header">
        <div class="flex justify-between">
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                {{ __('Dashboard') }}
            </h2>
            <h2 class="font-semibold text-xl text-gray-800 leading-tight">
                Total Users <span class="px-1 rounded-md bg-indigo-500 text-white">{{ count($users) }}</span>
            </h2>
        </div>
    </x-slot>

    <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 pb-3 mt-10 bg-white shadow-md text-gray-700">
        <div class="flex justify-between py-8">
            <div>
                <a href="{{ route('dashboard') }}" class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Dashboard >') }}
                </a>
                <a class="font-normal text-xl text-gray-800 leading-tight">
                    {{ __('Users') }}
                </a>
            </div>
            <div>
                <a href="{{ route('register') }}" class="bg-indigo-500 px-2 py-2 rounded-md text-white ...">Add User</a>
            </div>
        </div>
        <div class="bg-white overflow-hidden sm:rounded-lg">
            <table class="w-full border text-left">
                <thead>
                    <tr class="border-t-2 border-b-2 bg-indigo-100 border-indigo-500 ...">
                        <th class="p-3 sm:p-2">#</th>
                        <th class="p-3 sm:p-2">Name</th>
                        <th class="p-3 sm:p-2">Email</th>
                        <th class="p-3 sm:p-2">Created At</th>
                        <th class="p-3 sm:p-2">Updated At</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($users as $user)
                    <tr class="border-y border-indigo-500 ...">
                        <td  class="p-3">{{ $user->id }}</td>
                        <td  class="p-3">{{ $user->name }}</td>
                        <td  class="p-3">{{ $user->email }}</td>
                        <td  class="p-3">{{ Carbon\Carbon::parse($user->created_at)->diffForHumans() }}</td>
                        <td  class="p-3">{{ Carbon\Carbon::parse($user->updated_at)->diffForHumans() }}</td>
                    </tr>
                    @endforeach
                    
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
