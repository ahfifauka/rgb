<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Patroli RGB') }}
        </h2>
    </x-slot>
    <div class="p-6">
        <a href="{{ route('oprational.rgb') }}"
            class="bg-red-500 text-white rounded-md hover:bg-red-600 px-4 py-2 mb-4">Kembali</a>
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
        <div class="overflow-x-auto">
            <table id="data-table" class="min-w-full bg-gray-800 text-white rounded-md">
                <thead>
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Nama</th>
                        <th class="p-3 text-center">Nik</th>
                        <th class="p-3 text-center">Area</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($data as $item)
                        <tr>
                            <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                            <td class="p-3 text-center uppercase">{{ $item->name }}</td>
                            <td class="p-3 text-center uppercase">{{ $item->nik }}</td>
                            <td class="p-3 text-center uppercase">{{ $item->area }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('show.patroli', $item->nik) }}"
                                    class="text-blue-500 hover:underline">Detail</a>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</x-app-layout>
