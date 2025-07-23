<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 dark:text-gray-200 leading-tight">
            {{ __('Dashboard') }}
        </h2>
    </x-slot>

    <!-- SUKSES MELAKUKAN AKSI -->
    @if(session('success'))
        <x-modal name="success-modal" :show="true">
            <div class="flex flex-col items-center justify-center p-6">
                <h2 class="text-lg font-medium text-green-400 dark:text-white mb-4">
                    {{session('success')}}
                </h2>
                <div class="mt-4 flex justify-center">
                    <x-primary-button x-on:click="$dispatch('close')">
                        Tutup
                    </x-primary-button>
                </div>
            </div>
        </x-modal>
    @endif

    <div class="py-12">
        <!-- MODAL TAMBAH EVENT -->
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
                    <x-secondary-button x-on:click="$dispatch('close')">
                        Batal
                    </x-secondary-button>

                    <x-primary-button class="ml-3">
                        Simpan
                    </x-primary-button>
                </div>
            </form>
        </x-modal>

        <!-- MODAL UPDATE EVENT -->
        @foreach($events as $event)
            <x-modal name="edit-event-{{$event->id}}" focusable :show="$errors->any()">
                <form action="{{route('event.update', $event->id)}}" class="p-6" method="POST">
                    @csrf
                    @method('PUT')
                    <h2 class="text-lg font-medium text-black dark:text-white">Tambah Event Baru</h2>
                    <div class="mt-4">
                        <x-input-label for="judul" value="Judul"/>
                        <x-text-input id="judul" name="judul" type="text" class="mt-1 block w-full" autofocus value="{{old('judul', $event->judul)}}"/>
                        <x-input-error :messages="$errors->get('judul')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="deskripsi" value="Deskripsi"/>
                        <textarea id="deskripsi" name="deskripsi" class="mt-1 block w-full rounded-md shadow-sm ">{{old('deskripsi', $event->deskripsi)}}</textarea>
                        <x-input-error :messages="$errors->get('deskripsi')" class="mt-2"/>
                    </div>

                    <div class="mt-4">
                        <x-input-label for="tanggal_event" value="Tanggal"/>
                        <x-text-input id="tanggal_event" name="tanggal_event" type="text" class="mt-1 block w-full" type="datetime-local" value="{{old('tanggal_event', $event->tanggal_event)}}"/>
                        <x-input-error :messages="$errors->get('tanggal_event')" class="mt-2"/>
                    </div>

                    <div class="mt-6 flex justify-end">
                        <x-secondary-button x-on:click="$dispatch('close')">
                            Batal
                        </x-secondary-button>

                        <x-primary-button class="ml-3">
                            Simpan
                        </x-primary-button>
                    </div>
                </form>
            </x-modal>
        @endforeach

        <!-- MODAL DELETE EVENT -->
        @foreach($events as $event)
            <x-modal name="hapus-event-{{$event->id}}" >
                <div class="flex flex-col items-center justify-center p-6">
                    <h2 class="text-lg font-medium text-gray-800 dark:text-white mb-4">
                        Yakin ingin menghapus event <strong>{{ $event->judul }}</strong>?
                    </h2>
                    <form method="POST" action="{{ route('event.delete', $event->id) }}">
                        @csrf
                        @method('DELETE')
                        <div class="flex justify-end">
                            <x-secondary-button x-on:click="$dispatch('close')">Batal</x-secondary-button>
                            <x-danger-button class="ml-3">Hapus</x-danger-button>
                        </div>
                    </form>
                </div>
            </x-modal>
        @endforeach

        <!-- DASHBOARD -->
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white dark:bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-center ">
                    <h1 class="text-lg font-semibold">Selamat Datang {{$user->name}}!</h1>
                </div>
                <div class="p-6 text-gray-900 dark:text-gray-100 flex justify-end ">
                    <x-primary-button x-data="" x-on:click.prevent="$dispatch('open-modal', 'tambah-event')" ><i class="fa-solid fa-plus pr-2"></i> Tambah Event</x-primary-button>
                </div>
                <!-- LIST EVENT YANG BELUM SELESAI -->
                <div class="p-4">
                    <table class="w-full border border-black">
                        <tr class="w-full border border-black">
                            <th class="border border-black">Nama Acara</th>
                            <th class="border border-black">Deskripsi</th>
                            <th class="border border-black">Waktu</th>
                            <th class="border border-black">Aksi</th>
                        </tr>
                        @forelse($events as $event)
                        <tr class="w-full border border-black">
                            <td class="border border-black p-2">{{$event->judul}}</td>
                            <td class="border border-black p-2">{{$event->deskripsi ?: '-' }}</td>
                            <td class="border border-black p-2">{{$event->tanggal_formatted}}</td>
                            <td class="border border-black p-2">
                                <div class="flex justify-center align-middle gap-5">
                                    <i class="fa-solid fa-pen-to-square text-blue-600 text-lg hover:-translate-y-1 hover:cursor-pointer" x-data="" x-on:click.prevent="$dispatch('open-modal', 'edit-event-{{$event->id}}')" title="Edit"></i>
                                    <i class="fa-solid fa-square-check text-green-600 text-lg hover:-translate-y-1 hover:cursor-pointer" title="Tandai Selesai"></i>
                                    <i class="fa-solid fa-note-sticky text-yellow-500 text-lg hover:-translate-y-1 hover:cursor-pointer" title="Buat Catatan"></i>
                                    <i class="fa-solid fa-trash-can text-red-500 text-lg hover:-translate-y-1 hover:cursor-pointer" title="Hapus" x-data="" x-on:click.prevent="$dispatch('open-modal', 'hapus-event-{{$event->id}}')" title="Hapus"></i>
                                </div>
                            </td>
                        </tr>   
                        @empty
                        <td colspan="4" class="p-2">Belum ada Event</td>
                        @endforelse
                    </table>
                    <div class="mt-4">
                        {{$events->links()}}
                    </div>
                </div>

                <!-- LIST EVENT YANG TELAH SELESAI -->
            </div>
        </div>
    </div>
</x-app-layout>