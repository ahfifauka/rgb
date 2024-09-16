<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Daftar Inventaris') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('inventaris.create') }}"
            class="bg-blue-500 text-white rounded-md hover:bg-blue-600 px-4 py-2 mb-4">Tambah</a>
        <a href="{{ route('oprational.rgb') }}"
            class="bg-red-500 text-white rounded-md hover:bg-red-600 px-4 py-2 mb-4 ml-2">Kembali</a>
        <div class="mt-4 mb-4 flex justify-between items-center">
            <input type="text" id="search-input" placeholder="Search..."
                class="px-3 py-2 bg-gray-700 text-white rounded-md">
            <select id="page-length" class="px-3 py-2 bg-gray-700 text-white rounded-md">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>
        <div class="overflow-x-auto mt-4">
            <table id="data-table" class="min-w-full bg-gray-800 text-white rounded-md">
                <thead>
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Deskripsi Barang</th>
                        <th class="p-3 text-center">Lokasi</th>
                        <th class="p-3 text-center">Diperbaharui</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($inventaris as $item)
                        <tr>
                            <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                            <td class="p-3 text-left">
                                <ul class="list-disc list-inside pl-4">
                                    @foreach (explode(',', $item->deskripsi_barang) as $desc)
                                        @php
                                            // Pisahkan item dan jumlah dengan penanganan error
                                            $parts = explode(':', $desc);
                                            $nama = $parts[0] ?? '';
                                            $jumlah = $parts[1] ?? '';
                                        @endphp
                                        @if ($nama && $jumlah)
                                            <li>{{ trim($nama) }}: {{ trim($jumlah) }}</li>
                                        @endif
                                    @endforeach
                                </ul>
                            </td>
                            <td class="p-3 text-center uppercase">{{ $item->lokasi }}</td>
                            <td class="p-3 text-center uppercase">{{ $item->updated_at }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('inventaris.edit', $item->id) }}"
                                    class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('inventaris.destroy', $item->id) }}" method="POST"
                                    class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
