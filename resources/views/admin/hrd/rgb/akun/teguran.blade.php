<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Buat Surat Teguran') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mt-8">
            <h3 class="text-lg font-semibold">
                {{ request()->routeIs('DataRgb.create') ? __('Tambah Akun') : __('Pembuatan Surat Teguran') }}
            </h3>
            <form method="POST" action="{{ route('teguran.post') }}" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="name" class="block text-gray-300">Nama:</label>
                    <input type="text" id="name" name="name" value="{{ $users->name }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required readonly>
                </div>
                <div class="mb-4">
                    <label for="nik" class="block text-gray-300">Nik:</label>
                    <input type="text" id="nik" name="nik" value="{{ $users->nik }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required readonly>
                </div>
                <div class="mb-4">
                    <label for="jenis" class="block text-gray-300">Teguran ke-</label>
                    <select id="jenis" name="jenis" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                        <option disabled selected>-- Pilih Teguran ke.. --</option>
                        <option value="1">1</option>
                        <option value="2">2</option>
                        <option value="3">3</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="area" class="block text-gray-300">Keterangan:</label>
                    <textarea name="keterangan" class="w-full h-32 p-3 border text-black border-gray-300 rounded-lg focus:outline-none focus:ring-2 focus:ring-blue-500"></textarea>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Save</button>
                    <a href="{{ route('AkunRgb.index') }}"
                        class="ml-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div class="h-40"></div>
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            fetchNoSurat();
        });

        function fetchNoSurat() {
            const status = document.getElementById('status').value;
            axios.get(`/api/generate-no-surat/${status}`)
                .then(response => {
                    const noSurat = response.data.no_surat || generateNoSurat(1);
                    document.getElementById('no_surat').value = noSurat;
                })
                .catch(error => {
                    console.error('Terjadi kesalahan:', error);
                    document.getElementById('no_surat').value = generateNoSurat(1);
                });
        }

        function generateNoSurat(count) {
            const nomor = count.toString().padStart(5, '0'); // Misalnya 00001
            const bulan = new Date().toLocaleString('id-ID', {
                month: 'short'
            }).toUpperCase(); // Bulan
            const tahun = new Date().getFullYear(); // Tahun
            return `No. ${nomor}/SPT/HRD/RGB-86SS/${bulan}/${tahun}`;
        }
    </script>
</x-app-layout>