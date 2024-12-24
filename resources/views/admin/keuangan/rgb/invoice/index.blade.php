<!-- Flatpickr CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/flatpickr/dist/flatpickr.min.css">

<!-- Flatpickr JavaScript -->
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Invoice RGB') }}
        </h2>
    </x-slot>
    <div class="p-6">
        <div class="flex justify-between">
            <!-- Open modal trigger -->
            <div class="flex gap-2">
                <button type="button"
                    class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                    x-data x-on:click="$dispatch('open-modal', 'add-area-modal')">
                    Tambah
                </button>
                <a href="{{ route('keuangan.rgb') }}" class="p-2 bg-red-500 text-white rounded-md hover:bg-red-600">Kembali</a>
            </div>
            <div class="flex">
                <a href="{{route('cetak.invoice')}}" class="px-4 py-2 bg-blue-500 hover:bg-blue-600 rounded-md">Cetak</a>
            </div>
        </div>

        <!-- Search and Page Length -->
        <div class="mt-4 mb-4 flex justify-between items-center">
            <input type="text" id="search-input" placeholder="Search..."
                class="px-3 py-2 bg-gray-700 text-white rounded-md">
            <select id="page-length" class="px-3 py-2 bg-gray-700 text-white rounded-md">
                <option value="5">5</option>
                <option value="10" selected>10</option>
                <option value="25">25</option>
                <option value="50">50</option>
            </select>
        </div>

        <!-- Table with Horizontal Scrolling -->
        <div class="overflow-x-auto">
            <table id="data-table" class="min-w-full bg-gray-800 text-white rounded-md">
                <thead>
                    <tr>
                        <th class="p-3 whitespace-nowrap text-center">No</th>
                        <th class="p-3 whitespace-nowrap text-center">No Invoice</th>
                        <th class="p-3 whitespace-nowrap text-center">No Faktur</th>
                        <th class="p-3 whitespace-nowrap text-center">Customer</th>
                        <th class="p-3 whitespace-nowrap text-center">Total Personil</th>
                        <th class="p-3 whitespace-nowrap text-center">Harga</th>
                        <th class="p-3 whitespace-nowrap text-center">Rekening</th>
                        <th class="p-3 whitespace-nowrap text-center">Dibuat</th>
                        <th class="p-3 whitespace-nowrap text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($data as $account)
                    <tr>
                        <td class="p-3 whitespace-nowrap text-center uppercase">{{ $loop->iteration }}</td>
                        <td class="p-3 whitespace-nowrap text-center uppercase">{{ $account->no_invoice }}</td>
                        <td class="p-3 whitespace-nowrap text-center uppercase">{{ $account->no_faktur }}</td>
                        <td class="p-3 whitespace-nowrap text-center uppercase">{{ $account->customer }}</td>
                        <td class="p-3 whitespace-nowrap text-center uppercase">{{ $account->banyak }}</td>
                        <td class="p-3 whitespace-nowrap text-center uppercase">{{ $account->harga }}</td>
                        <td class="p-3 whitespace-nowrap text-center uppercase">{{ $account->rekening }}</td>
                        <td class="p-3 whitespace-nowrap text-center uppercase">{{ $account->created_at }}</td>
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex gap-2 justify-center">
                                <a href="" class="flex items-center justify-center w-28 h-10 bg-green-500 hover:bg-green-600 text-white rounded-md">
                                    <i class="fa-solid fa-download mr-2"></i> Invoice
                                </a>
                                <a href="{{ route('invoice.edit', $account->id) }}" class="flex items-center justify-center w-28 h-10 bg-yellow-500 hover:bg-yellow-600 text-white rounded-md">
                                    <i class="fa fa-pen mr-2"></i> Edit
                                </a>
                                <form action="{{ route('invoice.destroy', $account->id) }}" method="POST" class="inline-block">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="flex items-center justify-center w-28 h-10 bg-red-500 hover:bg-red-600 text-white rounded-md">
                                        <i class="fa fa-trash mr-2"></i> Delete
                                    </button>
                                </form>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <x-modal name="add-area-modal" focusable>
        <form action="{{ route('invoice.store') }}" method="POST">
            @csrf
            <div class="px-4 py-4">
                <h2 class="text-lg font-bold text-gray-900 dark:text-gray-100">
                    Buat Invoice
                </h2>
                <div class="mb-4 mt-4">
                    <label for="no_invoice" class="block text-white">No Invoice</label>
                    <input type="text" name="no_invoice" id="no_invoice"
                        class="w-full px-3 py-2 border rounded-md text-black" required readonly
                        value="{{ $invoiceNumber }}">
                </div>
                <div class="mb-4">
                    <label for="no_faktur" class="block text-white">No Faktur</label>
                    <input type="number" name="no_faktur" id="no_faktur"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mb-4">
                    <label for="customer" class="block text-white">Customer</label>
                    <select name="customer" id="customer" class="w-full px-3 py-2 border rounded-md text-black"
                        required>
                        <option value="" disabled selected>-- Pilih Customer --</option>
                        @foreach ($lokasi as $item)
                        <option value="{{ $item->area }}">{{ $item->area }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="mb-4">
                    <label for="banyak" class="block text-white">Banyak Personil</label>
                    <input type="number" name="banyak" id="banyak"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mb-4">
                    <label for="harga" class="block text-white">Harga</label>
                    <input type="number" name="harga" id="harga"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <div class="mb-4">
                    <label for="rekening" class="block text-white">Rekening</label>
                    <select name="rekening" id="rekening" class="w-full px-3 py-2 border rounded-md text-black">
                        <option disabled selected>-- Pilih Jenis Rekening --</option>
                        <option value="NON PPN | 1234567890 | BCA">NON PPN | 1234567890 | BCA</option>
                        <option value="PPN | 0987654321 | BRI">PPN | 0987654321 | BRI</option>
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
                    <input type="number" name="penggantian" id="penggantian"
                        class="w-full px-3 py-2 border rounded-md text-black" required>
                </div>
                <!-- Submit Button -->
                <div class="flex justify-end">
                    <button type="button" onclick="closeModal()"
                        class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</button>
                    <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                </div>
            </div>
        </form>
    </x-modal>
    <div class="h-20"></div>
    <!-- Add JavaScript to handle modal open/close with animation -->
    <script src="https://cdn.jsdelivr.net/npm/flatpickr"></script>
    <script>
        document.addEventListener("DOMContentLoaded", function() {
            flatpickr("#periode", {
                mode: "range",
                dateFormat: "Y-m-d",
                locale: {
                    rangeSeparator: " to "
                }
            });
            flatpickr("#due_date", {
                altInput: true,
                altFormat: "j F, Y",
                dateFormat: "Y-m-d",
            });
        });
    </script>
</x-app-layout>