<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Data Patroli') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="p-6">
            <div class="flex mb-4">
                <a href="{{ route('anggota.index') }}"
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
                        @foreach ($data as $item)
                        <tr>
                            <td class="p-3 whitespace-nowrap text-center uppercase">{{ $loop->iteration }}</td>
                            <td class="p-3 whitespace-nowrap text-center">{{ $item->name }}</td>
                            <td class="p-3 whitespace-nowrap text-center">{{ $item->nik }}</td>
                            <td class="p-3 whitespace-nowrap text-center">{{ $item->lokasi }}</td>
                            <td class="p-3 whitespace-nowrap text-center">{{ $item->situasi }}</td>
                            <td class="p-3 whitespace-nowrap text-center"><img src="{{asset('storage/'.$item->foto_anggota)}}" alt="" class="w-32 flex m-auto"></td>
                            <td class="p-3 whitespace-nowrap text-center"><img src="{{asset('storage/'.$item->foto_sekitar)}}" alt="" class="w-32 flex m-auto"></td>
                            <td class="p-3 whitespace-nowrap text-center">{{ $item->keterangan }}</td>
                            <!-- Tambahkan data lain sesuai kebutuhan -->
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
        <script>
            document.getElementById('search-input').addEventListener('keyup', function() {
                const searchTerm = this.value.toLowerCase();
                const rows = document.querySelectorAll('#data-table tbody tr');

                rows.forEach(row => {
                    const cells = row.querySelectorAll('td');
                    let found = false;

                    cells.forEach(cell => {
                        if (cell.textContent.toLowerCase().includes(searchTerm)) {
                            found = true;
                        }
                    });

                    if (found) {
                        row.style.display = ''; // Show row
                    } else {
                        row.style.display = 'none'; // Hide row
                    }
                });
            });
        </script>
        <div class="h-40"></div>
    </div>
</x-app-layout>