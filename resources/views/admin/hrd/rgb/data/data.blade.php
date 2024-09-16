<x-app-layout>
    <style>
        .hidden {
            display: none;
        }
    </style>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Buat Data RGB') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mt-8">
            <h3 class="text-lg font-semibold">
                {{ request()->routeIs('DataRgb.create') ? __('Tambah Akun') : __('Edit Akun') }}</h3>
            <form method="POST"
                action="{{ request()->routeIs('DataRgb.create') ? route('DataRgb.store') : route('DataRgb.update', $account->id) }}"
                class="mt-4">
                @csrf
                @if (request()->routeIs('DataRgb.edit'))
                    @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="name" class="block text-gray-300">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $account->name ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="email" class="block text-gray-300">Email:</label>
                    <input type="email" id="email" name="email"
                        value="{{ old('email', $account->email ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                </div>
                <!-- NIK Input -->
                <div class="mb-4">
                    <label for="nik" class="block text-gray-300">NIK:</label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik', $account->nik ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required readonly>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-gray-300">Username:</label>
                    <input type="text" id="username" name="username"
                        value="{{ old('username', $account->username ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-300">Role:</label>
                    <select id="role" name="role" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md"
                        required onchange="updateJabatanOptions(); updateLevelOptions();">
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role', $account->role ?? '') == 'admin' ? 'selected' : '' }}>
                            Admin</option>
                        <option value="user" {{ old('role', $account->role ?? '') == 'user' ? 'selected' : '' }}>User
                        </option>
                    </select>
                </div>

                <!-- Select Jabatan -->
                <div class="mb-4">
                    <label for="jabatan" class="block text-gray-300">Jabatan:</label>
                    <select id="jabatan" name="jabatan" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md"
                        required>
                        <option value="">Pilih Jabatan</option>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                </div>

                <!-- Select Level -->
                <div class="mb-4">
                    <label for="level" class="block text-gray-300">Level:</label>
                    <select id="level" name="level" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md"
                        required>
                        <option value="">Pilih level</option>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                </div>

                <div class="mb-4">
                    <label for="nohp" class="block text-gray-300">No HP:</label>
                    <input type="text" id="nohp" name="nohp" value="{{ old('nohp', $account->nohp ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="area" class="block text-gray-300">Area:</label>
                    <select name="area" id="area" class="w-full rounded-md bg-gray-700 text-white">
                        <option value="" disabled {{ old('area') ? '' : 'selected' }}>Pilih Area</option>
                        @foreach ($data as $item)
                            <option value="{{ $item->area }}"
                                {{ old('area', $account->area ?? '') == $item->area ? 'selected' : '' }}>
                                {{ $item->area }}</option>
                        @endforeach
                    </select>
                </div>


                <!-- New Fields -->
                <div class="mb-4">
                    <label for="alamat" class="block text-gray-300">Alamat:</label>
                    <input type="text" id="alamat" name="alamat"
                        value="{{ old('alamat', $account->alamat ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                </div>
                <div class="mb-4">
                    <label for="status" class="block text-gray-300">Status Pernikahan:</label>
                    <select id="status" name="status" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                        <option value="" disabled
                            {{ old('status', $account->status ?? '') == '' ? 'selected' : '' }}>Pilih
                            Status Pernikahan</option>
                        <option value="Belum Menikah"
                            {{ old('status', $account->status ?? '') == 'Belum Menikah' ? 'selected' : '' }}>
                            Belum Menikah</option>
                        <option value="Menikah"
                            {{ old('status', $account->status ?? '') == 'Menikah' ? 'selected' : '' }}>
                            Menikah</option>
                        <option value="Janda/Duda"
                            {{ old('status', $account->status ?? '') == 'Janda/Duda' ? 'selected' : '' }}>
                            Janda/Duda</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="name_pasangan" class="block text-gray-300">Nama Istri/Suami:</label>
                    <input type="text" id="name_pasangan" name="name_pasangan"
                        value="{{ old('name_pasangan', $account->name_pasangan ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                </div>
                <div class="mb-4">
                    <label for="name_anak" class="block text-gray-300">Nama Anak:</label>
                    <input type="text" id="name_anak" name="name_anak"
                        value="{{ old('name_anak', $account->name_anak ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                </div>
                <div class="mb-4">
                    <label for="golongan_darah" class="block text-gray-300">Golongan Darah:</label>
                    <input type="text" id="golongan_darah" name="golongan_darah"
                        value="{{ old('golongan_darah', $account->golongan_darah ?? '') }}"
                        class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                </div>

                <!-- Checkboxes -->
                <div class="">
                    <label class="block text-gray-300">Dokumen:</label>
                    @foreach (['ktp', 'skck', 'lamaran', 'foto', 'surat_sehat', 'kk', 'izin_ortu', 'paklaring', 'sim'] as $document)
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="{{ $document }}" name="{{ $document }}"
                                value="ya" {{ old($document, $account->$document ?? '') ? 'checked' : '' }}
                                class="mr-2" onchange="toggleSubOptions('{{ $document }}')">
                            <label for="{{ $document }}" class="text-gray-300">{{ ucfirst($document) }}</label>
                        </div>
                    @endforeach

                    <!-- Sub-checkboxes for SIM -->
                    <div id="sim-options" class="ml-6 flex gap-2 hidden">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="sim-a" name="sim_option[]" value="A"
                                class="mr-2">
                            <label for="sim-a" class="text-gray-300">SIM A</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="sim-b1" name="sim_option[]" value="B1"
                                class="mr-2">
                            <label for="sim-b1" class="text-gray-300">SIM B1</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="sim-b2" name="sim_option[]" value="B2"
                                class="mr-2">
                            <label for="sim-b2" class="text-gray-300">SIM B2</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="sim-c" name="sim_option[]" value="C"
                                class="mr-2">
                            <label for="sim-c" class="text-gray-300">SIM C</label>
                        </div>
                    </div>
                </div>

                <div class="">
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="ijazah" name="ijazah" value="ya"
                            {{ old('ijazah', $account->ijazah ?? '') ? 'checked' : '' }} class="mr-2"
                            onchange="toggleSubOptions('ijazah')">
                        <label for="ijazah" class="text-gray-300">Ijazah</label>
                    </div>

                    <!-- Sub-checkboxes for Ijazah -->
                    <div id="ijazah-options" class="ml-6 flex gap-2 hidden">
                        <div class="flex items-center mb-2">
                            <input type="radio" id="smp" name="ijazah_level" value="smp" class="mr-2"
                                {{ old('ijazah_level', $account->ijazah_level ?? '') == 'smp' ? 'checked' : '' }}>
                            <label for="smp" class="text-gray-300">SMP</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="radio" id="sma" name="ijazah_level" value="sma" class="mr-2"
                                {{ old('ijazah_level', $account->ijazah_level ?? '') == 'sma' ? 'checked' : '' }}>
                            <label for="sma" class="text-gray-300">SMA</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="radio" id="sarjana" name="ijazah_level" value="sarjana" class="mr-2"
                                {{ old('ijazah_level', $account->ijazah_level ?? '') == 'sarjana' ? 'checked' : '' }}>
                            <label for="sarjana" class="text-gray-300">Sarjana</label>
                        </div>
                    </div>
                </div>

                <!-- Separate Ijazah Section -->
                <div class="mb-4">
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="kta" name="kta" value="ya"
                            {{ old('kta', $account->kta ?? '') ? 'checked' : '' }} class="mr-2"
                            onchange="toggleSubOptions('kta')">
                        <label for="kta" class="text-gray-300">Kta</label>
                    </div>

                    <!-- Sub-checkboxes for Ijazah -->
                    <div id="kta-options" class="ml-6 hidden">
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="pratama" name="kta_option[]" value="pratama"
                                class="mr-2">
                            <label for="pratama" class="text-gray-300">Garda Pratama</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="madya" name="kta_option[]" value="madya"
                                class="mr-2">
                            <label for="madya" class="text-gray-300">Garda Madya</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="checkbox" id="utama" name="kta_option[]" value="utama"
                                class="mr-2">
                            <label for="utama" class="text-gray-300">Garda Utama</label>
                        </div>
                    </div>

                </div>


                <div class="mb-4 ">
                    <label class="block text-gray-300">Jenis Kelamin:</label>
                    <div class="flex flex-wrap md:flex-nowrap gap-2">
                        <div class="flex items-center mb-2">
                            <input type="radio" id="laki-laki" name="jenis_kelamin" value="Laki-laki"
                                class="mr-2"
                                {{ old('jenis_kelamin', $account->jenis_kelamin ?? '') == 'Laki-laki' ? 'checked' : '' }}>
                            <label for="laki-laki" class="text-gray-300">Laki-laki</label>
                        </div>
                        <div class="flex items-center mb-2">
                            <input type="radio" id="perempuan" name="jenis_kelamin" value="Perempuan"
                                class="mr-2"
                                {{ old('jenis_kelamin', $account->jenis_kelamin ?? '') == 'Perempuan' ? 'checked' : '' }}>
                            <label for="perempuan" class="text-gray-300">Perempuan</label>
                        </div>
                    </div>
                </div>

                <!-- Radio Buttons for Religion -->
                <div class="mb-4">
                    <label class="block text-gray-300">Agama:</label>
                    <div class="flex flex-wrap md:flex-nowrap gap-2">
                        @foreach (['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $religion)
                            <div class="flex items-center mb-2 md:mb-0">
                                <input type="radio" id="religion_{{ $loop->index }}" name="agama"
                                    value="{{ $religion }}"
                                    {{ old('religion', $account->religion ?? '') == $religion ? 'checked' : '' }}>
                                <label for="religion_{{ $loop->index }}"
                                    class="text-gray-300">{{ $religion }}</label>
                            </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit"
                        class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Save</button>
                    <a href="{{ route('DataRgb.index') }}"
                        class="ml-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Cancel</a>
                </div>
            </form>
        </div>
    </div>
    <div class="h-40"></div>
    <script>
        // Predefined jabatan options for admin and user roles
        const jabatanOptions = {
            admin: ['Oprational', 'Administrasi', 'HRD'],
            user: ['Anggota']
        };

        // Predefined level options for admin and user roles
        const levelOptions = {
            admin: ['Staff', 'Manops', 'Korwil', 'Manajer'],
            user: ['Anggota', 'Chief', 'Danru']
        };

        // Function to update jabatan options based on the selected role
        function updateJabatanOptions() {
            const role = document.getElementById('role').value;
            const jabatanSelect = document.getElementById('jabatan');

            // Clear existing options
            jabatanSelect.innerHTML = '<option value="">Pilih Jabatan</option>';

            // If a valid role is selected, populate corresponding jabatan options
            if (jabatanOptions[role]) {
                jabatanOptions[role].forEach(function(jabatan) {
                    const option = document.createElement('option');
                    option.value = jabatan.toLowerCase();
                    option.text = jabatan;
                    jabatanSelect.appendChild(option);
                });
            }
        }

        // Function to update level options based on the selected role
        function updateLevelOptions() {
            const role = document.getElementById('role').value;
            const levelSelect = document.getElementById('level');

            // Clear existing options
            levelSelect.innerHTML = '<option value="">Pilih Level</option>';

            // If a valid role is selected, populate corresponding level options
            if (levelOptions[role]) {
                levelOptions[role].forEach(function(level) {
                    const option = document.createElement('option');
                    option.value = level.toLowerCase();
                    option.text = level;
                    levelSelect.appendChild(option);
                });
            }
        }

        // Trigger the functions to load initial options if editing an account
        document.addEventListener('DOMContentLoaded', function() {
            updateJabatanOptions();
            updateLevelOptions();
        });
    </script>

    <script>
        // Fetch last NIK from the server and auto-generate the next one
        fetch('{{ route('last-id') }}')
            .then(response => response.json())
            .then(data => {
                var lastId = data.lastId || 'RGB-86.10.00.0000';

                // Extract the last number from the previous NIK
                var lastNumber = parseInt(lastId.split('.')[3]);

                // Increment by 1 to generate the next number
                var nextNumber = lastNumber + 1;

                // Format the number with leading zeros (4 digits)
                var formattedNumber = ('0000' + nextNumber).slice(-4);

                // Get current date
                const currentDate = new Date();

                // Get month in 'MM' format
                const month = String(currentDate.getMonth() + 1).padStart(2, '0');

                // Get last two digits of the current year
                const year = String(currentDate.getFullYear()).slice(-2);

                // Generate the new NIK
                var newNik = 'RGB-86.10.' + year + '.' + formattedNumber;

                // Set the generated NIK in the input field
                document.getElementById('nik').value = newNik;
            })
            .catch(error => console.error('Error:', error));
    </script>
    <script>
        function toggleSubOptions(docName) {
            // Handle Ijazah
            if (docName === 'ijazah') {
                const ijazahOptions = document.getElementById('ijazah-options');
                ijazahOptions.classList.toggle('hidden');
            }

            if (docName === 'kta') {
                const ktaOptions = document.getElementById('kta-options');
                ktaOptions.classList.toggle('hidden');
            }

            // Handle SIM
            if (docName === 'sim') {
                const simOptions = document.getElementById('sim-options');
                simOptions.classList.toggle('hidden');
            }
        }
    </script>

</x-app-layout>
