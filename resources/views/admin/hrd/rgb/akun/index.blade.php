<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Data Akun RGB') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <!-- Button to Open Form -->
        <a href="{{ route('hrd.rgb') }}" class=" bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Kembali</a>

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
                        <th class="p-3 text-center">ID</th>
                        <th class="p-3 text-center">Name</th>
                        <th class="p-3 text-center">NIK</th>
                        <th class="p-3 text-center">Username</th>
                        <th class="p-3 text-center">Jabatan</th>
                        <th class="p-3 text-center">Donwload berkas</th>
                        <th class="p-3 text-center">Tools</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($data as $account)
                    <tr>
                        <td class="p-3 text-center">{{ $account->id }}</td>
                        <td class="p-3 text-center">{{ $account->name }}</td>
                        <td class="p-3 text-center">{{ $account->nik }}</td>
                        <td class="p-3 text-center">{{ $account->username }}</td>
                        <td class="p-3 text-center">{{ $account->jabatan }}</td>
                        @php
                        $suratRealExists = $suratStatus->get($account->nik)?->contains('status', 'Real');
                        $suratSemenExists = $suratStatus->get($account->nik)?->contains('status', 'Sementara');
                        @endphp
                        <td class="p-3 text-center">
                            <div class="flex gap-2 justify-center items-center">
                                @if ($suratRealExists)
                                <a href="{{ route('suratR.cetak', $account->nik) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
                                    <i class="fa-solid fa-download"></i> Real
                                </a>
                                @else
                                <span class="bg-red-500 text-white text-sm rounded-md inline-flex items-center"
                                    style="padding: 0 5px 0 5px">
                                    Real Belum dibuat</span>
                                @endif
                                @if ($suratSemenExists)
                                <a href="{{ route('suratS.cetak', $account->nik) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600"><i
                                        class="fa-solid fa-download"></i> Sementara</a>
                                @else
                                <span class="bg-red-500 text-white text-sm rounded-md inline-flex items-center"
                                    style="padding: 0 5px 0 5px">
                                    Sementara Belum dibuat</span>
                                @endif

                            </div>
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex gap-2 justify-center items-center">
                                <a href="{{ route('AkunRgb.edit', $account->id) }}"
                                    class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">Surat
                                    Tugas</a>
                                <a href="{{ route('AkunRgb.edit', $account->id) }}"
                                    class="bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Surat Peringatan</a>
                                <a href="{{ route('AkunRgb.edit', $account->id) }}"
                                    class="bg-green-500 text-white px-4 py-2 rounded-md hover:bg-green-600">Id
                                    Card</a>
                            </div>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

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
</x-app-layout>