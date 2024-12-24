<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Invoice RGB') }}
        </h2>
    </x-slot>
    <div class="p-6">
        <form action="{{route('invoice.update', $data->id)}}" method="post">
            @csrf
            @method('PUT')
            <div class="mb-4 mt-4">
                <label for="no_invoice" class="block text-white">No Invoice</label>
                <input type="text" name="no_invoice" id="no_invoice"
                    class="w-full px-3 py-2 border rounded-md text-black" required readonly
                    value="{{ $data->no_invoice }}">
            </div>
            <div class="mb-4">
                <label for="no_faktur" class="block text-white">No Faktur</label>
                <input type="number" name="no_faktur" id="no_faktur" value="{{ $data->no_faktur }}"
                    class="w-full px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mb-4">
                <label for="customer" class="block text-white">Customer</label>
                <select name="customer" id="customer" class="w-full px-3 py-2 border rounded-md text-black"
                    required>
                    <option value="" disabled selected>-- Pilih Customer --</option>
                    @foreach ($lokasi as $item)
                    <option value="{{ $item->area }}" {{ $data->customer == $data->customer ? 'selected' : '' }}>{{ $item->area }}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-4">
                <label for="banyak" class="block text-white">Banyak Personil</label>
                <input type="number" name="banyak" id="banyak" value="{{ $data->banyak }}"
                    class="w-full px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mb-4">
                <label for="harga" class="block text-white">Harga</label>
                <input type="number" name="harga" id="harga" value="{{$data->harga}}"
                    class="w-full px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mb-4">
                <label for="rekening" class="block text-white">Rekening</label>
                <select name="rekening" id="rekening" class="w-full px-3 py-2 border rounded-md text-black">
                    <option disabled selected>-- Pilih Jenis Rekening --</option>
                    <option value="NON PPN | 1234567890 | BCA" {{ $data->rekening == $data->rekening ? 'selected' : '' }}>NON PPN | 1234567890 | BCA</option>
                    <option value="PPN | 0987654321 | BRI" {{ $data->rekening == $data->rekening ? 'selected' : '' }}>PPN | 0987654321 | BRI</option>
                </select>
            </div>
            <div class="mb-4">
                <label for="periode" class="block text-white">Pilih Periode</label>
                <input type="text" id="periode" name="periode"
                    class="w-full px-3 py-2 border text-black border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                    placeholder="Pilih periode" required>
            </div>
            <div class="mb-4">
                <label for="due_date" class="block text-white">Jatuh Tempo</label>
                <input type="text" id="due_date" name="due_date"
                    class="w-full px-3 py-2 border text-black border-gray-300 rounded-md focus:outline-none focus:ring focus:ring-indigo-200 focus:border-indigo-500"
                    placeholder="Pilih Jatuh Tempo" required>
            </div>
            <div class="mb-4">
                <label for="penggantian" class="block text-white">Penggantian</label>
                <input type="number" name="penggantian" id="penggantian" value="{{$data->penggantian}}"
                    class="w-full px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="flex justify-end">
                <button type="submit" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-md">Simpan</button>
            </div>
        </form>
    </div>
    <div class="h-40"></div>
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            const defaultPeriode = JSON.parse('@json($data->periode ? explode(" to ", $data->periode) : null)');

            flatpickr("#periode", {
                mode: "range",
                dateFormat: "Y-m-d",
                locale: {
                    rangeSeparator: " to "
                },
                defaultDate: defaultPeriode
            });

            flatpickr("#due_date", {
                altInput: true,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
                defaultDate: "{{ $data->due_date }}"
            });
        });
    </script>
</x-app-layout>