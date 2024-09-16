<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Detail Patroli NIK: ' . $nik) }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="flex mb-4">
            <a href="{{ route('patroli.index') }}"
                class="bg-red-500 text-white rounded-md hover:bg-red-600 px-4 py-2">Kembali</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800 text-white rounded-md">
                <thead>
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Nama</th>
                        <th class="p-3 text-center">Nik</th>
                        <th class="p-3 text-center">Lokasi</th>
                        <th class="p-3 text-center">Situasi</th>
                        <th class="p-3 text-center">Foto Anggota</th>
                        <th class="p-3 text-center">Foto Sekitar</th>
                        <th class="p-3 text-center">Keterangan</th>

                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($patrolData as $item)
                        <tr>
                            <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                            <td class="p-3 text-center">{{ $item->tanggal }}</td>
                            <td class="p-3 text-center">{{ $item->keterangan }}</td>
                            <td class="p-3 text-center">{{ $item->lokasi }}</td>
                            <td class="p-3 text-center">{{ $item->situasi }}</td>
                            <td class="p-3 text-center">{{ $item->foto_anggota }}</td>
                            <td class="p-3 text-center">{{ $item->foto_sekitar }}</td>
                            <td class="p-3 text-center">{{ $item->keterangan }}</td>
                            <!-- Tambahkan data lain sesuai kebutuhan -->
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>


    </div>
</x-app-layout>
