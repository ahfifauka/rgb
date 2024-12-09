<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Area RGB') }}
        </h2>
    </x-slot>
    <div class="p-6">
        <div class="flex gap-2">
            <!-- Open modal trigger -->
            <button type="button"
                class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                x-data x-on:click="$dispatch('open-modal', 'add-area-modal')">
                Tambah
            </button>
            <a href="{{ route('keuangan.rgb') }}" class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600">Kembali</a>
        </div>

        <!-- Search and Page Length -->
        <div class="mt-4 mb-4 flex justify-between items-center">
            <input type="text" id="search-input" placeholder="Search..." class="px-3 py-2 bg-gray-700 text-white rounded-md">
            <select id="page-length" class="px-3 py-2 bg-gray-700 text-white rounded-md">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>

        <!-- Table with Horizontal Scrolling -->
        <div class="overflow-x-auto">
            <table id="data-table" class="min-w-full bg-gray-800 text-white rounded-md">
                <thead>
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Area</th>
                        <th class="p-3 text-center">Gaji</th>
                        <th class="p-3 text-center">Pajak</th>
                        <th class="p-3 text-center">Alamat</th>
                        <th class="p-3 text-center">Lokasi</th>
                        <th class="p-3 text-center">Tunjangan Makan</th>
                        <th class="p-3 text-center">Tunjangan Transport</th>
                        <th class="p-3 text-center">Inventaris</th>
                        <th class="p-3 text-center">Kontak</th>
                        <th class="p-3 text-center">Dibuat</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $account)
                    <tr>
                        <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->area }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->gaji }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->pajak }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->alamat }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->lokasi }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->tunj_makan }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->tunj_trans }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->inventaris }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->kontak }}</td>
                        <td class="p-3 text-center uppercase">{{ $account->created_at ?? $account->updated_at }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('Area.edit', $account->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('Area.destroy', $account->id) }}" method="POST" class="inline-block ml-2">
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

    <!-- x-modal component -->
    <x-modal name="add-area-modal" focusable>
        <form action="{{ route('Area.store') }}" method="POST" class="p-6">
            @csrf
            <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                Tambah Area
            </h2>

            <div class="mt-4">
                <label for="area" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Area</label>
                <input type="text" name="area" id="area" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="gaji" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Gaji</label>
                <input type="number" name="gaji" id="gaji" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="pajak" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Pajak</label>
                <select name="pajak" id="pajak" class="w-full mt-1 px-3 py-2 border rounded-md text-black">
                    <option disabled selected>-- Pilih Pajak --</option>
                    <option value="NON PPN">NON PPN</option>
                    <option value="PPN">PPN</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="alamat" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Alamat</label>
                <input type="text" name="alamat" id="alamat" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="lokasi" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Lokasi</label>
                <select name="lokasi" id="lokasi" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
                    <option value="" disabled selected>Pilih Lokasi</option>
                    @foreach ($lokasi as $item)
                    <option value="{{ $item->lokasi }}">{{ $item->lokasi }}</option>
                    @endforeach
                </select>
            </div>

            <div class="mt-4">
                <label for="tunj_makan" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Tunjangan Makan</label>
                <input type="number" name="tunj_makan" id="tunj_makan" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="tunj_trans" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Tunjangan Transport</label>
                <input type="number" name="tunj_trans" id="tunj_trans" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="inventaris" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Inventaris</label>
                <input type="text" name="inventaris" id="inventaris" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-4">
                <label for="kontak" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Kontak</label>
                <input type="text" name="kontak" id="kontak" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
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
    <div class="h-20"></div>
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
</x-app-layout>