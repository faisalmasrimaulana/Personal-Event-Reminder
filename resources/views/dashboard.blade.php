<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <x-modal name="tambah-event" focusable :show="$errors->any()">
            <form action="{{route('event.store')}}" class="p-6" method="POST">
                @csrf
                <h2 class="text-lg font-medium text-black dark:text-white">Tambah Event Baru</h2>
                <div class="mt-4">
                    <x-input-label for="judul" value="Judul"/>
                    <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" autofocus value="{{old('judul')}}"/>
                    <x-input-error :messages="$errors->get('judul')" class="mt-2"/>
                </div>

                <div class="mt-4">
                    <x-input-label for="deskripsi" value="Deskripsi"/>
                    <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full rounded-md shadow-sm ">{{old('deskripsi')}}</textarea>
                    <x-input-error :messages="$errors->get('deskripsi')" class="mt-2"/>
                </div>

                <div class="mt-4">
                    <x-input-label for="tanggal_event" value="Tanggal"/>
                    <x-text-input id="tanggal_event" name="tanggal_event" type="text" class="mt-1 block w-full" type="datetime-local" value="{{old('tanggal_event')}}"/>
                    <x-input-error :messages="$errors->get('tanggal_event')" class="mt-2"/>
                </div>

                <div class="mt-6 flex justify-end">
                    <x-danger-button x-on:click="$dispatch('close')">
                        Batal
                    </x-danger-button>

                    <x-primary-button class="ml-3">
                        Simpan
                    </x-primary-button>
                </div>
            </form>
        </x-modal>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center ">
                    <h1 class="text-lg font-semibold">Selamat Datang {{$user->name}}!</h1>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-end ">
                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'tambah-event')" ><i class="fa-solid fa-plus pr-2"></i> Tambah Event</x-primary-button>
                </div>
            </div>
        </div>
    </div>
</x-app-layout>