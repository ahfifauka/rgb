<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Generate QR Code') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <form method="POST" action="{{ route('patroli.store') }}">
            @csrf
            <div class="mb-4">
                <label for="area" class="block text-sm font-medium text-white">Pilih Data Area</label>
                <select id="area" name="area" class="mt-1 block w-full rounded-md border-gray-300 shadow-sm text-black" required>
                    <option value="" disabled selected>-- Pilih Area --</option>
                    @foreach($data as $item)
                    <option class="text-black" value="{{$item->area}}">{{$item->area}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="lokasi" class="block text-sm font-medium text-white">Lokasi</label>
                <input type="text" id="lokasi" name="lokasi" class="mt-1 block w-full rounded-md text-black border-gray-300 shadow-sm" required>
            </div>
            <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white py-2 px-4 rounded">
                Generate & Download QR Code
            </button>
        </form>
    </div>
</x-app-layout>