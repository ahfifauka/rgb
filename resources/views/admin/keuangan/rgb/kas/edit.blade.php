<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Edit Kas') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <form action="{{ route('kas.update', $kas->id) }}" method="POST">
            @csrf
            @method('PUT')

            <div class="mb-4">
                <label for="tanggal" class="block text-white">Tanggal</label>
                <input type="date" name="tanggal" id="tanggal" value="{{ $kas->tanggal }}"
                    class="w-full px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mb-4">
                <label for="jenis" class="block text-white">Jenis</label>
                <input type="text" name="jenis" id="jenis" value="{{ $kas->jenis }}"
                    class="w-full px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mb-4">
                <label for="jumlah" class="block text-white">Jumlah</label>
                <input type="number" name="jumlah" id="jumlah" value="{{ $kas->jumlah }}"
                    class="w-full px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mb-4">
                <label for="keterangan" class="block text-white">Keterangan</label>
                <textarea name="keterangan" id="keterangan" class="w-full px-3 py-2 border rounded-md text-black">{{ $kas->keterangan }}</textarea>
            </div>
            <div class="mb-4">
                <label for="tipe" class="block text-white">Tipe</label>
                <select name="tipe" id="tipe" class="w-full px-3 py-2 border rounded-md text-black" required>
                    <option value="masuk" {{ $kas->tipe == 'masuk' ? 'selected' : '' }}>Masuk</option>
                    <option value="keluar" {{ $kas->tipe == 'keluar' ? 'selected' : '' }}>Keluar</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="nama_pembayar" class="block text-white">Nama Pembayar</label>
                <input type="text" name="nama_pembayar" id="nama_pembayar" value="{{ $kas->nama_pembayar }}"
                    class="w-full px-3 py-2 border rounded-md text-black">
            </div>
            <div class="mb-4">
                <label for="metode_pembayaran" class="block text-white">Metode Pembayaran</label>
                <input type="text" name="metode_pembayaran" id="metode_pembayaran"
                    value="{{ $kas->metode_pembayaran }}" class="w-full px-3 py-2 border rounded-md text-black">
            </div>
            <div class="mb-4">
                <label for="referensi" class="block text-white">Referensi</label>
                <input type="text" name="referensi" id="referensi" value="{{ $kas->referensi }}"
                    class="w-full px-3 py-2 border rounded-md text-black">
            </div>

            <div class="flex justify-end items-center gap-3">
                <a href="{{ route('kas.index') }}"
                    class="bg-red-500 text-white rounded-md hover:bg-red-600 px-4 py-2">Kembali</a>
                <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Update</button>
            </div>
        </form>
    </div>
    <div class="h-36"></div>
</x-app-layout>
