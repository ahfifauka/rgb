<style>
    .weekend {
        color: red;
    }
</style>
<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Schedule Marketing') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <!-- Button to Open Form -->
        <button type="button"
            class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
            onclick="openModal()">
            Tambah
        </button>
        <a href="{{ route('rgb.Marketing') }}"
            class="ml-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Kembali</a>

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
                        <th rowspan="2" class="p-3 text-center">No</th>
                        <th rowspan="2" class="p-3 text-center">Project</th>
                        <th rowspan="2" class="p-3 text-center">Alamat</th>
                        <th rowspan="2" class="p-3 text-center">Status</th>
                        @for ($i = 1; $i <= $daysInMonth; $i++)
                            <th class="text-center">{{ $i }}</th>
                        @endfor
                        <th rowspan="2" class="p-3 text-center">Keterangan</th>
                    </tr>
                    <tr>
                        @foreach ($headers as $index => $header)
                            <th class="text-center {{ in_array($index + 1, $weekends) ? 'weekend' : '' }}">
                                {{ $header }}</th>
                        @endforeach
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($data as $item)
                        <tr>
                            <td rowspan="9" class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                            <td rowspan="9" class="p-3 text-center uppercase">{{ $item->project }}</td>
                            <td rowspan="9" class="p-3 text-center uppercase">{{ $item->alamat }}</td>
                            <td class="p-3 text-center uppercase"> Analisa Data</td>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <td class="text-center uppercase">
                                    <div class="flex w-4 h-4 bg-white m-auto"></div>
                                </td>
                            @endfor
                            <td class="p-3 text-center uppercase">{{ $item->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-center uppercase">Compro</td>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <td class="text-center uppercase">
                                    <div class="flex w-4 h-4 bg-white m-auto"></div>
                                </td>
                            @endfor
                            <td class="p-3 text-center uppercase">{{ $item->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-center uppercase">Penawaran</td>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <td class="text-center uppercase">
                                    <div class="flex w-4 h-4 bg-white m-auto"></div>
                                </td>
                            @endfor
                            <td class="p-3 text-center uppercase">{{ $item->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-center uppercase">Follow Up</td>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <td class="text-center uppercase">
                                    <div class="flex w-4 h-4 bg-white m-auto"></div>
                                </td>
                            @endfor
                            <td class="p-3 text-center uppercase">{{ $item->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-center uppercase">Survei Area</td>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <td class="text-center uppercase">
                                    <div class="flex w-4 h-4 bg-white m-auto"></div>
                                </td>
                            @endfor
                            <td class="p-3 text-center uppercase">{{ $item->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-center uppercase">Fresentasi</td>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <td class="text-center uppercase">
                                    <div class="flex w-4 h-4 bg-white m-auto"></div>
                                </td>
                            @endfor
                            <td class="p-3 text-center uppercase">{{ $item->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-center uppercase">Negosiasi</td>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <td class="text-center uppercase">
                                    <div class="flex w-4 h-4 bg-white m-auto"></div>
                                </td>
                            @endfor
                            <td class="p-3 text-center uppercase">{{ $item->keterangan }}</td>
                        </tr>
                        <tr>
                            <td class="p-3 text-center uppercase">Closing</td>
                            @for ($day = 1; $day <= $daysInMonth; $day++)
                                <td class="text-center uppercase">
                                    <div class="flex w-4 h-4 bg-white m-auto"></div>
                                </td>
                            @endfor
                            <td class="p-3 text-center uppercase">{{ $item->keterangan }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="customModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 transition-opacity ease-out duration-300 opacity-0 pointer-events-none">
        <div class="bg-gray-800 rounded-lg shadow-lg max-w-lg w-full transform transition-all duration-500 scale-95 opacity-0"
            id="modalContent">
            <!-- Modal header -->
            <div class="flex justify-between items-center py-3 px-4 border-b">
                <h3 class="font-bold text-white">
                    Tambah Marketing Plan
                </h3>
                <button type="button"
                    class="inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200"
                    onclick="closeModal()">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal content -->
            <div class="p-4">
                <form action="{{ route('MarketingPlan.store') }}" method="POST">
                    @csrf
                    <div class="mb-4">
                        <label for="project" class="block text-white">Project Name</label>
                        <input type="text" name="project" id="project"
                            class="w-full px-3 py-2 border rounded-md text-black" required>
                    </div>
                    <div class="mb-4">
                        <label for="contac_person" class="block text-white">Contact Person</label>
                        <input type="text" name="contac_person" id="contac_person"
                            class="w-full px-3 py-2 border rounded-md text-black" required>
                    </div>
                    <div class="mb-4">
                        <label for="nohp" class="block text-white">Number Phone</label>
                        <input type="text" name="nohp" id="nohp"
                            class="w-full px-3 py-2 border rounded-md text-black" required>
                    </div>
                    <div class="mb-4">
                        <label for="posisi" class="block text-white">Position</label>
                        <input type="text" name="posisi" id="posisi"
                            class="w-full px-3 py-2 border rounded-md text-black" required>
                    </div>
                    <div class="mb-4">
                        <label for="alamat" class="block text-white">Address</label>
                        <input type="text" name="alamat" id="alamat"
                            class="w-full px-3 py-2 border rounded-md text-black" required>
                    </div>
                    <div class="mb-4">
                        <label for="prediksi" class="block text-white">Prediction Time</label>
                        <input type="text" name="prediksi" id="prediksi"
                            class="w-full px-3 py-2 border rounded-md text-black" required>
                    </div>
                    <div class="mb-4">
                        <label for="proggres" class="block text-white">Progress</label>
                        <input type="text" name="proggres" id="proggres"
                            class="w-full px-3 py-2 border rounded-md text-black" required>
                    </div>
                    <div class="mb-4">
                        <label for="personil_r" class="block text-white">Personil Requirement</label>
                        <input type="number" name="personil_r" id="personil_r"
                            class="w-full px-3 py-2 border rounded-md text-black" required>
                    </div>
                    <div class="mb-4">
                        <label for="hasil" class="block text-white">Hasil</label>
                        <input type="text" name="hasil" id="hasil"
                            class="w-full px-3 py-2 border rounded-md text-black" required>
                    </div>


                    <!-- Submit Button -->
                    <div class="flex justify-end">
                        <button type="button" onclick="closeModal()"
                            class="px-4 py-2 bg-gray-500 text-white rounded-md mr-2">Batal</button>
                        <button type="submit" class="px-4 py-2 bg-blue-500 text-white rounded-md">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
    <div class="h-20"></div>

    <!-- Create/Edit Form -->


    <!-- JavaScript for DataTable -->
    <script src="https://cdn.datatables.net/1.13.4/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/1.13.4/js/dataTables.bootstrap4.min.js"></script>
    <script>
        $(document).ready(function() {
            let table = $('#data-table').DataTable({
                pageLength: 10,
                lengthMenu: [5, 10, 25, 50],
                searching: true,
                responsive: true
            });

            $('#page-length').on('change', function() {
                table.page.len(parseInt($(this).val())).draw();
            });

            $('#search-input').on('keyup', function() {
                table.search($(this).val()).draw();
            });
        });
    </script>
    <script>
        function openModal() {
            const modal = document.getElementById('customModal');
            const modalContent = document.getElementById('modalContent');

            // Show the modal background
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100');
            }, 10); // Delay to trigger CSS transition

            // Animate the modal content (scale up and fade in)
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('customModal');
            const modalContent = document.getElementById('modalContent');

            // Animate the modal content (scale down and fade out)
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            // Hide the modal background after animation completes
            setTimeout(() => {
                modal.classList.add('opacity-0', 'pointer-events-none');
                modal.classList.remove('opacity-100');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300); // Time for the background to fade out
            }, 300); // Time for the modal content animation
        }
    </script>
</x-app-layout>
