<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Buat & Edit Data RGB') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mt-8">
            <h3 class="text-lg font-semibold">{{ request()->routeIs('DataRgb.create') ? __('Tambah Akun') : __('Edit Akun') }}</h3>
            <form method="POST" action="{{ request()->routeIs('DataRgb.create') ? route('DataRgb.store') : route('DataRgb.update', $account->id) }}" class="mt-4">
                @csrf
                @if(request()->routeIs('DataRgb.edit'))
                @method('PUT')
                @endif

                <div class="mb-4">
                    <label for="name" class="block text-gray-300">Name:</label>
                    <input type="text" id="name" name="name" value="{{ old('name', $account->name ?? '') }}" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                </div>
                <!-- NIK Input -->
                <div class="mb-4">
                    <label for="nik" class="block text-gray-300">NIK:</label>
                    <input type="text" id="nik" name="nik" value="{{ old('nik', $account->nik ?? '') }}" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required readonly>
                </div>
                <div class="mb-4">
                    <label for="username" class="block text-gray-300">Username:</label>
                    <input type="text" id="username" name="username" value="{{ old('username', $account->username ?? '') }}" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="role" class="block text-gray-300">Role:</label>
                    <select id="role" name="role" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required onchange="updateJabatanOptions()">
                        <option value="">Pilih Role</option>
                        <option value="admin" {{ old('role', $account->role ?? '') == 'admin' ? 'selected' : '' }}>Admin</option>
                        <option value="user" {{ old('role', $account->role ?? '') == 'user' ? 'selected' : '' }}>User</option>
                    </select>
                </div>

                <!-- Select Jabatan -->
                <div class="mb-4">
                    <label for="jabatan" class="block text-gray-300">Jabatan:</label>
                    <select id="jabatan" name="jabatan" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                        <option value="">Pilih Jabatan</option>
                        <!-- Options will be dynamically populated by JavaScript -->
                    </select>
                </div>

                <!-- Select Level -->
                <div class="mb-4">
                    <label for="level" class="block text-gray-300">Level:</label>
                    <select id="level" name="level" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                        <option value="staff" {{ old('level', $account->level ?? '') == 'staff' ? 'selected' : '' }}>Staff</option>
                        <option value="manops" {{ old('level', $account->level ?? '') == 'manops' ? 'selected' : '' }}>Manops</option>
                        <option value="korwil" {{ old('level', $account->level ?? '') == 'korwil' ? 'selected' : '' }}>Korwil</option>
                        <option value="manajer" {{ old('level', $account->level ?? '') == 'manajer' ? 'selected' : '' }}>Manajer</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="nohp" class="block text-gray-300">No HP:</label>
                    <input type="text" id="nohp" name="nohp" value="{{ old('nohp', $account->nohp ?? '') }}" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                </div>
                <div class="mb-4">
                    <label for="area" class="block text-gray-300">Area:</label>
                    <input type="text" id="area" name="area" value="{{ old('area', $account->area ?? '') }}" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md" required>
                </div>

                <!-- New Fields -->
                <div class="mb-4">
                    <label for="address" class="block text-gray-300">Alamat:</label>
                    <input type="text" id="address" name="address" value="{{ old('address', $account->address ?? '') }}" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                </div>
                <div class="mb-4">
                    <label for="marital_status" class="block text-gray-300">Status Pernikahan:</label>
                    <select id="marital_status" name="marital_status" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                        <option value="" disabled {{ old('marital_status', $account->marital_status ?? '') == '' ? 'selected' : '' }}>Pilih Status Pernikahan</option>
                        <option value="Belum Menikah" {{ old('marital_status', $account->marital_status ?? '') == 'Belum Menikah' ? 'selected' : '' }}>Belum Menikah</option>
                        <option value="Menikah" {{ old('marital_status', $account->marital_status ?? '') == 'Menikah' ? 'selected' : '' }}>Menikah</option>
                        <option value="Janda/Duda" {{ old('marital_status', $account->marital_status ?? '') == 'Janda/Duda' ? 'selected' : '' }}>Janda/Duda</option>
                    </select>
                </div>

                <div class="mb-4">
                    <label for="spouse_name" class="block text-gray-300">Nama Istri/Suami:</label>
                    <input type="text" id="spouse_name" name="spouse_name" value="{{ old('spouse_name', $account->spouse_name ?? '') }}" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                </div>
                <div class="mb-4">
                    <label for="children_name" class="block text-gray-300">Nama Anak:</label>
                    <input type="text" id="children_name" name="children_name" value="{{ old('children_name', $account->children_name ?? '') }}" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                </div>
                <div class="mb-4">
                    <label for="blood_type" class="block text-gray-300">Golongan Darah:</label>
                    <input type="text" id="blood_type" name="blood_type" value="{{ old('blood_type', $account->blood_type ?? '') }}" class="w-full px-3 py-2 bg-gray-700 text-white rounded-md">
                </div>

                <!-- Checkboxes -->
                <div class="mb-4">
                    <label class="block text-gray-300">Dokumen:</label>
                    @foreach(['ktp', 'kta', 'skck', 'surat lamaran', 'pas foto', 'surat sehat', 'ijazah', 'kartu keluarga', 'izin orang tua', 'lampiran'] as $document)
                    <div class="flex items-center mb-2">
                        <input type="checkbox" id="{{ $document }}" name="{{ $document }}" value="1" {{ old($document, $account->$document ?? '') ? 'checked' : '' }} class="mr-2">
                        <label for="{{ $document }}" class="text-gray-300">{{ ucfirst($document) }}</label>
                    </div>
                    @endforeach
                </div>

                <!-- Radio Buttons for Religion -->
                <div class="mb-4">
                    <label class="block text-gray-300">Agama:</label>
                    <div class="flex flex-wrap md:flex-nowrap gap-2">
                        @foreach(['Islam', 'Kristen', 'Katolik', 'Hindu', 'Budha', 'Konghucu'] as $religion)
                        <div class="flex items-center mb-2 md:mb-0">
                            <input type="radio" id="religion_{{ $loop->index }}" name="religion" value="{{ $religion }}" {{ old('religion', $account->religion ?? '') == $religion ? 'checked' : '' }}>
                            <label for="religion_{{ $loop->index }}" class="text-gray-300">{{ $religion }}</label>
                        </div>
                        @endforeach
                    </div>
                </div>

                <div class="flex justify-end">
                    <button type="submit" class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Save</button>
                    <a href="{{ route('DataRgb.index') }}" class="ml-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Cancel</a>
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

        // Trigger the function to load initial jabatan options if editing an account
        document.addEventListener('DOMContentLoaded', function() {
            updateJabatanOptions();
        });
    </script>
    <script>
        // Fetch last NIK from the server and auto-generate the next one
        fetch('{{ route("last-id") }}')
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
</x-app-layout>