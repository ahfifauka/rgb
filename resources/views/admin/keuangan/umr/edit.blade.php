<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Edit Umr tahun Ini') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('umr.update', $data->id) }}" method="POST">
            @csrf
            @method('PUT')
            <div class="mb-4">
                <label for="lokasi" class="block text-white">lokasi</label>
                <input type="text" name="lokasi" id="lokasi" value="{{ $data->lokasi }}"
                    class="w-full px-3 py-2 border rounded-md text-white bg-gray-800" required>
            </div>
            <div class="mb-4">
                <label for="umr" class="block text-white">UMR</label>
                <input type="number" name="umr" id="umr" value="{{ $data->umr }}"
                    class="w-full px-3 py-2 border rounded-md text-white bg-gray-800" required>
            </div>
            <!-- Submit Button -->
            <div class="flex justify-end">
                <button type="button" onclick="closeModal()"
                    class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</button>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
            </div>
        </form>
    </div>
</x-app-layout>
