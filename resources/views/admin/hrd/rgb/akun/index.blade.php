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
                        $suratP = $suratStatus2->get($account->nik)?->contains('status', 'peringatan');
                        $suratT = $suratStatus2->get($account->nik)?->contains('status', 'teguran');
                        @endphp
                        <td class="p-3 text-center">
                            <div class="flex gap-2 justify-center items-center">
                                <button type="button"
                                    class="py-2 px-4 inline-flex items-center whitespace-nowrap gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    x-data x-on:click="$dispatch('open-modal', 'add-area-modal2-{{ $account->id }}')">
                                    Donwload Surat
                                </button>
                            </div>
                        </td>
                        <td class="p-3 text-center">
                            <div class="flex gap-2 justify-center items-center">
                                <button type="button"
                                    class="py-2 px-4 inline-flex items-center whitespace-nowrap gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                                    x-data x-on:click="$dispatch('open-modal', 'add-area-modal-{{ $account->id }}')">
                                    Buat Surat
                                </button>
                            </div>
                        </td>
                    </tr>
                    <x-modal name="add-area-modal-{{ $account->id }}" focusable>
                        <div class="container mx-auto p-4 bg-black rounded-lg shadow">
                            <h2 class="text-lg font-bold text-white mb-4">Pilih form Surat</h2>
                            <div class="space-y-3">
                                <!-- Tombol 1 -->
                                <a href="{{ route('AkunRgb.edit', $account->id) }}"
                                    class="block w-full bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600">
                                    Surat Tugas
                                </a>
                                <!-- Tombol 2 -->
                                <a href="{{ route('peringatan') }}"
                                    class="block w-full bg-red-500 text-white px-4 py-2 rounded-md text-center hover:bg-red-600">
                                    Surat Peringatan
                                </a>
                                <!-- Tombol 3 -->
                                <a href="{{ route('teguran') }}"
                                    class="block w-full bg-red-700 text-white px-4 py-2 rounded-md text-center hover:bg-red-800">
                                    Surat Teguran
                                </a>
                                <!-- Tombol 4 -->
                                <a href="{{ route('AkunRgb.edit', $account->id) }}"
                                    class="block w-full bg-green-500 text-white px-4 py-2 rounded-md text-center hover:bg-green-600">
                                    ID Card
                                </a>
                            </div>
                            <!-- Tombol Batal -->
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    Batal
                                </x-secondary-button>
                            </div>
                        </div>
                    </x-modal>
                    <x-modal name="add-area-modal2-{{ $account->id }}" focusable>
                        <div class="container mx-auto p-4 bg-black rounded-lg shadow">
                            <h2 class="text-lg font-bold text-white mb-4">Pilih Dokumen</h2>
                            <div class="space-y-3">
                                <!-- Tombol 1 -->
                                @if ($suratRealExists)
                                <a href="{{ route('suratR.cetak', $account->nik) }}"
                                    class="block w-full bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600">
                                    <i class="fa-solid fa-download"></i> Real
                                </a>
                                @else
                                <span class="block w-full bg-red-500 text-white px-4 py-2 rounded-md text-center"
                                    style="padding: 0 5px 0 5px">
                                    Real Belum dibuat</span>
                                @endif
                                @if ($suratSemenExists)
                                <a href="{{ route('suratS.cetak', $account->nik) }}"
                                    class="block w-full bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600"><i
                                        class="fa-solid fa-download"></i> Sementara</a>
                                @else
                                <span class="block w-full bg-red-500 text-white px-4 py-2 rounded-md text-center"
                                    style="padding: 0 5px 0 5px">
                                    Sementara Belum dibuat</span>
                                @endif
                                @if ($suratP)
                                <a href="{{ route('peringatan.cetak', $account->nik) }}"
                                    class="block w-full bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600"><i
                                        class="fa-solid fa-download"></i> SP</a>
                                @else
                                <span class="block w-full bg-red-500 text-white px-4 py-2 rounded-md text-center"
                                    style="padding: 0 5px 0 5px">
                                    SP Belum dibuat</span>
                                @endif
                                @if ($suratT)
                                <a href="{{ route('teguran.cetak', $account->nik) }}"
                                    class="block w-full bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600"><i
                                        class="fa-solid fa-download"></i> Teguran</a>
                                @else
                                <span class="block w-full bg-red-500 text-white px-4 py-2 rounded-md text-center"
                                    style="padding: 0 5px 0 5px">
                                    Teguran Belum dibuat</span>
                                @endif
                                <span class="block w-full bg-red-500 text-white px-4 py-2 rounded-md text-center"
                                    style="padding: 0 5px 0 5px">
                                    ID card Belum dibuat</span>
                            </div>
                            <!-- Tombol Batal -->
                            <div class="mt-6 flex justify-end">
                                <x-secondary-button x-on:click="$dispatch('close')">
                                    Batal
                                </x-secondary-button>
                            </div>
                        </div>
                    </x-modal>
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