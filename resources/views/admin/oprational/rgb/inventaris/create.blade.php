<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Tambah Inventaris') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('inventaris.index') }}"
            class="bg-red-500 text-white rounded-md hover:bg-red-600 px-4 py-2 mb-4">Kembali</a>
        <form action="{{ route('inventaris.store') }}" method="POST" class="mt-4">
            @csrf

            <!-- Nama Barang -->
            <div>
                <label for="nama_barang" class="block text-gray-300 mb-2">Nama Barang:</label>
                <div class="flex flex-col sm:flex-row sm:gap-4 gap-2 items-start sm:items-center">
                    <!-- Input Nama Barang -->
                    <input type="text" id="nama_barang"
                        class="w-full h-10 rounded-md border-gray-300 bg-gray-200 text-black"
                        placeholder="Masukkan Nama Barang">

                    <!-- Increment-Decrement Jumlah Barang -->
                    <div class="flex items-center gap-2">
                        <label for="jumlah_barang" class="text-gray-300">Jumlah</label>
                        <button type="button" id="decrement"
                            class="px-2 py-1 bg-gray-400 text-white rounded">-</button>
                        <input type="text" id="jumlah_barang" value="1"
                            class="w-16 h-10 text-center border-gray-300 rounded-md bg-gray-200 text-black">
                        <button type="button" id="increment"
                            class="px-2 py-1 bg-gray-400 text-white rounded">+</button>
                    </div>

                    <!-- Tombol Tambah Barang -->
                    <button type="button" id="addItem"
                        class="bg-blue-500 text-white rounded-md hover:bg-blue-600 px-4 py-2 whitespace-nowrap">
                        Tambahkan Barang
                    </button>
                </div>
            </div>

            <!-- List Barang yang ditambahkan -->
            <div class="mt-4">
                <label class="block text-gray-300 mb-2">Barang yang Ditambahkan :</label>
                <ul id="itemList" class="text-white"></ul>
            </div>

            <!-- Hidden Input untuk menyimpan hasil -->
            <input type="hidden" name="deskripsi_barang" id="deskripsi_barang">

            <!-- Lokasi -->
            <div class="mt-4">
                <label for="lokasi" class="block text-gray-300 mb-2">Lokasi:</label>
                <select name="lokasi" id="lokasi"
                    class="w-full h-10 rounded-md border-gray-300 bg-gray-200 text-black">
                    <option disabled selected>-- Pilih Lokasi --</option>
                    @foreach ($data as $item)
                        <option value="{{ $item->area }}">{{ $item->area }}</option>
                    @endforeach
                </select>
            </div>

            <!-- Tombol Simpan -->
            <button type="submit"
                class="bg-blue-500 text-white mt-4 rounded-md hover:bg-blue-600 px-4 py-2 w-full sm:w-auto">Simpan
                Inventaris</button>
        </form>
    </div>

    <!-- JavaScript untuk Increment-Decrement dan Menambahkan Barang -->
    <script>
        document.getElementById('increment').addEventListener('click', function() {
            let jumlah = parseInt(document.getElementById('jumlah_barang').value);
            document.getElementById('jumlah_barang').value = jumlah + 1;
        });

        document.getElementById('decrement').addEventListener('click', function() {
            let jumlah = parseInt(document.getElementById('jumlah_barang').value);
            if (jumlah > 1) {
                document.getElementById('jumlah_barang').value = jumlah - 1;
            }
        });

        document.getElementById('addItem').addEventListener('click', function() {
            let namaBarang = document.getElementById('nama_barang').value;
            let jumlahBarang = document.getElementById('jumlah_barang').value;

            if (namaBarang.trim() !== '' && jumlahBarang > 0) {
                // Tambahkan barang ke list
                let itemList = document.getElementById('itemList');
                let newItem = document.createElement('li');
                newItem.textContent = `${namaBarang}: ${jumlahBarang}`;
                itemList.appendChild(newItem);

                // Reset inputan
                document.getElementById('nama_barang').value = '';
                document.getElementById('jumlah_barang').value = '1';

                // Tambahkan data ke hidden input
                let deskripsiBarang = document.getElementById('deskripsi_barang').value;
                deskripsiBarang += `${namaBarang}:${jumlahBarang}, `;
                document.getElementById('deskripsi_barang').value = deskripsiBarang.trim();
            } else {
                alert('Silahkan masukkan nama barang dan jumlah yang valid.');
            }
        });
    </script>
</x-app-layout>
