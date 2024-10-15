<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Data Umr tahun Ini') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('anggota.index') }}"
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
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Name</th>
                        <th class="p-3 text-center">Nik</th>
                        <th class="p-3 text-center">Photo</th>
                        <th class="p-3 text-center">Lokasi</th>
                        <th class="p-3 text-center">Keterangan</th>
                        <th class="p-3 text-center">Shift</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($data as $item)
                    <tr>
                        <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->name }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->nik }}</td>
                        <td class="p-3 text-center uppercase"><img src="{{ asset($item->image) }}"
                                class="w-40 h-30 flex m-auto" alt="Captured Image">
                        </td>
                        <td class="p-3 flex justify-center text-center uppercase">
                            <iframe src="{{ $item->location }}&output=embed" width="300" height="100"
                                style="border:0;" allowfullscreen loading="lazy"></iframe>
                        </td>
                        <td class="p-3 text-center uppercase">{{ $item->ket1 }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->sesi }}</td>

                        <td class="p-3 text-center">
                            @if (isset($item->ket2) && $item->ket2 !== '')
                            <p class="text-center text-green-600">Sudah Pulang</p>
                            @else
                            <a href="{{ route('presensi.pulang', $item->id) }}"
                                class="bg-blue-500 p-2 rounded hover:bg-blue-600">Presensi Pulang</a>
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
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