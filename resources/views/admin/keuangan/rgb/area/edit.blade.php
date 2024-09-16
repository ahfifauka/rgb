<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Edit Area') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mt-6">
            <!-- Form untuk Edit -->
            <form action="{{ route('Area.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT')

                <div class="mb-4">
                    <label for="area" class="block text-white">Area</label>
                    <input type="text" name="area" id="area" value="{{ $data->area }}"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mb-4">
                    <label for="gaji" class="block text-white">Gaji</label>
                    <input type="number" name="gaji" id="gaji" value="{{ $data->gaji }}"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mb-4">
                    <label for="pajak" class="block text-white">Pajak</label>
                    <select name="pajak" id="pajak" class="w-full px-3 py-2 border rounded-md text-black">
                        <option value="NON PPN" {{ $data->pajak == 'NON PPN' ? 'selected' : '' }}>NON PPN</option>
                        <option value="PPN" {{ $data->pajak == 'PPN' ? 'selected' : '' }}>PPN</option>
                    </select>
                </div>
                <div class="mb-4">
                    <label for="alamat" class="block text-white">Alamat</label>
                    <input type="text" name="alamat" id="alamat" value="{{ $data->alamat }}"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mb-4">
                    <label for="lokasi" class="block text-white">Lokasi</label>
                    <select name="lokasi" id="lokasi" class="w-full px-3 py-2 border rounded-md text-black"
                        required>
                        <option value="" disabled selected>Pilih Lokasi</option>
                        @foreach ($lokasi as $item)
                            <option value="{{ $item->lokasi }}">{{ $item->lokasi }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="tunj_makan" class="block text-white">Tunjangan Makan</label>
                    <input type="number" name="tunj_makan" id="tunj_makan" value="{{ $data->tunj_makan }}"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mb-4">
                    <label for="tunj_trans" class="block text-white">Tunjangan Transport</label>
                    <input type="number" name="tunj_trans" id="tunj_trans" value="{{ $data->tunj_trans }}"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mb-4">
                    <label for="inventaris" class="block text-white">Inventaris</label>
                    <input type="text" name="inventaris" id="inventaris" value="{{ $data->inventaris }}"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mb-4">
                    <label for="kontak" class="block text-white">Kontak</label>
                    <input type="text" name="kontak" id="kontak" value="{{ $data->kontak }}"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <!-- Submit Button -->
                <div class="flex justify-end gap-2">
                    <a href="{{ route('Area.index') }}" class="ml-2 bg-red-500 text-white rounded-md hover:bg-red-600"
                        style="padding: 10px 10px 10px 10px">Kembali</a>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update</button>
                </div>
            </form>
        </div>
    </div>
    <div class="h-36"></div>
</x-app-layout>
