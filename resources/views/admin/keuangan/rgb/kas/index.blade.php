<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Daftar Kas') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-4 gap-4 mb-6">
            <!-- Saldo Card -->
            <div class="bg-gray-800 p-4 rounded-lg shadow-md text-white">
                <h3 class="text-lg font-semibold">Saldo</h3>
                <p class="text-xl mt-2">Rp. {{ number_format($saldo, 2) }}</p>
            </div>

            <!-- Pemasukan Card -->
            <div class="bg-gray-800 p-4 rounded-lg shadow-md text-white">
                <h3 class="text-lg font-semibold">Pemasukan</h3>
                <p class="text-xl mt-2">Rp. {{ number_format($pemasukan, 2) }}</p>
            </div>

            <!-- Pengeluaran Card -->
            <div class="bg-gray-800 p-4 rounded-lg shadow-md text-white">
                <h3 class="text-lg font-semibold">Pengeluaran</h3>
                <p class="text-xl mt-2">Rp. {{ number_format($pengeluaran, 2) }}</p>
            </div>

            <!-- Selisih Card -->
            <div class="bg-gray-800 p-4 rounded-lg shadow-md text-white">
                <h3 class="text-lg font-semibold">Selisih</h3>
                <p class="text-xl mt-2">Rp. {{ number_format($selisih, 2) }}</p>
            </div>
        </div>
        <div class="flex gap-2">
            <button type="button"
                class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                x-data x-on:click="$dispatch('open-modal', 'add-area-modal')">
                Tambah
            </button>

            <a href="{{ route('keuangan.rgb') }}" class="bg-red-500 text-white rounded-md hover:bg-red-600"
                style="padding: 10px 10px 10px 10px">Kembali</a>
        </div>

        <!-- Search and Page Length -->
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

        <!-- Table with Horizontal Scrolling -->
        <div class="overflow-x-auto">
            <table id="data-table" class="min-w-full bg-gray-800 text-white rounded-md">
                <thead>
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Tanggal</th>
                        <th class="p-3 text-center">Jenis</th>
                        <th class="p-3 text-center">Jumlah</th>
                        <th class="p-3 text-center">Keterangan</th>
                        <th class="p-3 text-center">Tipe</th>
                        <th class="p-3 text-center">Nama Pembayar</th>
                        <th class="p-3 text-center">Metode Pembayaran</th>
                        <th class="p-3 text-center">Referensi</th>
                        <th class="p-3 text-center">Saldo</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($data as $item)
                    <tr>
                        <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->tanggal }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->jenis }}</td>
                        <td class="p-3 text-center uppercase">{{ number_format($item->jumlah, 2) }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->keterangan }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->tipe }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->nama_pembayar }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->metode_pembayaran }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->referensi }}</td>
                        <td class="p-3 text-center uppercase">{{ number_format($item->saldo, 2) }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('kas.edit', $item->id) }}"
                                class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('kas.destroy', $item->id) }}" method="POST"
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

    <x-modal name="add-area-modal" focusable>
        <div class="px-4 py-4">
            <form action="{{ route('kas.store') }}" method="POST">
                @csrf
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                    Kas
                </h2>

                <div class="mt-4">
                    <label for="tanggal" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Tanggal</label>
                    <input type="date" name="tanggal" id="tanggal"
                        class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mt-4">
                    <label for="jenis" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Tipe</label>
                    <select name="jenis" id="jenis" class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                        required>
                        <option selected>-- Pilih Jenis --</option>
                        <option value="pemasukan">Pemasukan</option>
                        <option value="pengeluaran">Pengeluaran</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="jumlah" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Jumlah</label>
                    <input type="number" name="jumlah" id="jumlah"
                        class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mt-4">
                    <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Keterangan</label>
                    <textarea name="keterangan" id="keterangan" class="w-full mt-1 px-3 py-2 border rounded-md text-black"></textarea>
                </div>
                <div class="mt-4">
                    <label for="tipe" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Tipe</label>
                    <select name="tipe" id="tipe" class="w-full mt-1 px-3 py-2 border rounded-md text-black"
                        required>
                        <option selected>-- Pilih Tipe --</option>
                        <option value="masuk">Masuk</option>
                        <option value="keluar">Keluar</option>
                    </select>
                </div>
                <div class="mt-4">
                    <label for="nama_pembayar" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Nama Pembayar</label>
                    <input type="text" name="nama_pembayar" id="nama_pembayar"
                        class="w-full mt-1 px-3 py-2 border rounded-md text-black">
                </div>
                <div class="mt-4">
                    <label for="metode_pembayaran" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Metode Pembayaran</label>
                    <input type="text" name="metode_pembayaran" id="metode_pembayaran"
                        class="w-full mt-1 px-3 py-2 border rounded-md text-black">
                </div>
                <div class="mt-4">
                    <label for="referensi" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Referensi</label>
                    <input type="text" name="referensi" id="referensi"
                        class="w-full mt-1 px-3 py-2 border rounded-md text-black">
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
        </div>
    </x-modal>
    <div class="h-26"></div>
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