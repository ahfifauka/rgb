<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Penggajian PPN RGB') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mb-4 py-2">
            <a href="{{ route('penggajian.index') }}" class=" bg-red-500 text-white rounded-md hover:bg-red-600"
                style="padding: 10px 10px 10px 10px">Kembali</a>
        </div>

        <!-- Area Selection -->
        <label for="area" class="block text-gray-300 mb-2">Pilih Area</label>
        <select name="area" id="area" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
            <option disabled selected>Pilih Area</option>
            @foreach ($area as $item)
                <option value="{{ $item->area }}">{{ $item->area }}</option>
            @endforeach
        </select>

        <!-- Form Area for User Data -->
        <form action="{{ route('penggajian.store') }}" method="POST" class="mt-4">
            @csrf
            <div id="user-forms" class="mt-4"></div>
            <button type="submit"
                class="bg-blue-500 text-white rounded-md hover:bg-blue-600 mt-4 px-4 py-2">Simpan</button>
        </form>
    </div>
    <div class="h-20"></div>
    <script>
        document.getElementById('area').addEventListener('change', function() {
            let selectedArea = this.value;
            let userFormsContainer = document.getElementById('user-forms');

            // Reset the form container before loading new data
            userFormsContainer.innerHTML = '';

            if (selectedArea) {
                let url = "{{ route('getUsersByArea') }}?area=" + selectedArea;

                fetch(url)
                    .then(response => {
                        if (!response.ok) {
                            throw new Error('Network response was not ok');
                        }
                        return response.text(); // Ubah jadi .text() sementara untuk melihat hasil response
                    })
                    .then(responseText => {
                        console.log('Raw Response:', responseText); // Debugging: Log the raw response

                        try {
                            const users = JSON.parse(responseText); // Parsing ke JSON
                            if (users.length > 0) {
                                users.forEach(user => {
                                    let form = `
                                <div class="flex mt-6"><p class="text-xl">${user.name}</p></div>
                                <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
                                    <div>
                                        <label for="nama" class="block text-gray-300">Nama</label>
                                        <input type="text" name="nama" value="${user.name}" readonly class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="nik" class="block text-gray-300">NIK</label>
                                        <input type="text" name="nik" value="${user.nik}" readonly class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="total_absen" class="block text-gray-300">Total Absen</label>
                                        <input type="number" name="total_absen" value="${user.total_absen || 0}" readonly class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="gaji_pokok" class="block text-gray-300">Gaji Pokok</label>
                                        <input type="number" name="gaji_pokok" value="${user.gaji || 0}" readonly class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="tunj_makan" class="block text-gray-300">Tunjangan Makan</label>
                                        <input type="number" name="tunj_makan" value="${user.tunj_makan || 0}" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="tunj_transport" class="block text-gray-300">Tunjangan Transport</label>
                                        <input type="number" name="tunj_transport" value="${user.tunj_trans || 0}" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="tunj_jabatan" class="block text-gray-300">Tunjangan Jabatan</label>
                                        <input type="number" name="tunj_jabatan" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="masa_kerja" class="block text-gray-300">Masa Kerja</label>
                                        <input type="number" name="masa_kerja" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="tunj_klien" class="block text-gray-300">Tunjangan Klien</label>
                                        <input type="number" name="tunj_klien" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="lemburan" class="block text-gray-300">Lemburan</label>
                                        <input type="number" name="lemburan" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="bpjs_kerja" class="block text-gray-300">BPJS Kerja</label>
                                        <input type="number" name="bpjs_kerja" value="${user.bpjs_naker}" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="bpjs_sehat" class="block text-gray-300">BPJS Sehat</label>
                                        <input type="number" name="bpjs_sehat" value="${user.bpjs_nakes}" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="cashbon" class="block text-gray-300">Cashbon</label>
                                        <input type="number" name="cashbon" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="koperasi" class="block text-gray-300">Koperasi</label>
                                        <input type="number" name="koperasi" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="potongan_absen" class="block text-gray-300">Potongan Absen</label>
                                        <input type="number" name="potongan_absen" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="tanggung_renteng" class="block text-gray-300">Tanggung Renteng</label>
                                        <input type="number" name="tanggung_renteng" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="donasi" class="block text-gray-300">Donasi</label>
                                        <input type="number" name="donasi" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="backup" class="block text-gray-300">Backup</label>
                                        <input type="number" name="backup" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="potongan" class="block text-gray-300">PPH 21</label>
                                        <input type="number" name="potongan" value="" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    </div>
                                    <div>
                                        <label for="area" class="block text-gray-300">Area</label>
                                        <input type="text" name="area" value="${user.area}" readonly class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                                    <div>
                                </div>
                            </form>
                        `;
                                    userFormsContainer.innerHTML += form;
                                });
                            } else {
                                userFormsContainer.innerHTML =
                                    '<p class="text-gray-300 mt-4">Tidak ada data ditemukan untuk area yang dipilih.</p>';
                            }
                        } catch (error) {
                            console.error('Error parsing JSON:', error);
                            userFormsContainer.innerHTML =
                                '<p class="text-red-500 mt-4">Terjadi kesalahan saat memuat data.</p>';
                        }
                    })
                    .catch(error => {
                        console.error('Error:', error);
                        userFormsContainer.innerHTML =
                            '<p class="text-red-500 mt-4">Terjadi kesalahan saat memuat data.</p>';
                    });
            }
        });
    </script>

</x-app-layout>
