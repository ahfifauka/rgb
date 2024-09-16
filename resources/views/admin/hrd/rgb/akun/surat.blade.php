<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Buat Surat Tugas') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mt-8">
            <h3 class="text-lg font-semibold">
                {{ request()->routeIs('DataRgb.create') ? __('Tambah Akun') : __('Pembuatan Surat Tugas') }}</h3>
            <form method="POST" action="{{ route('surat.store') }}" class="mt-4">
                @csrf
                <div class="mb-4">
                    <label for="no_surat" class="block text-gray-300">No Surat:</label>
                    <input type="text" id="no_surat" name="no_surat"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required readonly>
                </div>
                <div class="mb-4">
                    <label for="name" class="block text-gray-300">Nama:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $account->name ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required readonly>
                </div>
                <div class="mb-4">
                    <label for="nik" class="block text-gray-300">Nik:</label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik', $account->nik ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required readonly>
                </div>
                <div class="mb-4">
                    <label for="level" class="block text-gray-300">Posisi:</label>
                    <input type="text" id="level" name="level"
                        value="{{ old('level', $account->level ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required readonly>
                </div>
                <div class="mb-4">
                    <label for="area" class="block text-gray-300">Penempatan Area:</label>
                    <select id="area" name="area" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                        <option disabled selected>-- Pilih Penempatan Area --</option>
                        <option value="Mako">Mako</option>
                        <option value="Seiko">Seiko</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="area" class="block text-gray-300">Penempatan Area:</label>
                    <select id="status" name="status" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md"
                        onchange="fetchNoSurat()">
                        <option disabled selected>-- Pilih Status Tugas --</option>
                        <option value="Real">Real</option>
                        <option value="Sementara">Sementara</option>
                    </select>
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
