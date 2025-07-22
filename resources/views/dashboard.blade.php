<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center ">
                    <h1 class="text-lg font-semibold">Selamat Datang {{$user->name}}!</h1>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-end ">
                    <x-primary-button><i class="fa-solid fa-plus pr-2"></i> Tambah Event</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>
