<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Penggajian Non PPN RGB') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="mb-2 py-2">
            <a href="{{ route('penggajian.index') }}" class=" bg-red-500 text-white rounded-md hover:bg-red-600"
                style="padding: 10px 10px 10px 10px">Kembali</a>
        </div>
        <label for="area" class="block text-gray-300 mb-2">Pilih Area</label>
        <select name="area" id="area" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
            <option disabled selected>Pilih Area</option>
            @foreach ($area as $item)
                <option value="{{ $item->area }}">{{ $item->area }}</option>
            @endforeach
        </select>
    </div>
</x-app-layout>
