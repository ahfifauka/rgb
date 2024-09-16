<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Data Anggota RGB') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <!-- Button to Open Form -->
        <a href="{{ route('DataRgb.create') }}" class="bg-blue-500 text-white px-4 py-2 rounded-md hover:bg-blue-600">
            Tambah Data
        </a>
        <a href="{{ route('hrd.rgb') }}"
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
                        <th class="p-3 text-center">NIK</th>
                        <th class="p-3 text-center">Username</th>
                        <th class="p-3 text-center">Jabatan</th>
                        <th class="p-3 text-center">level</th>
                        <th class="p-3 text-center">No HP</th>
                        <th class="p-3 text-center">Area</th>
                        <th class="p-3 text-center">KTA</th>
                        <th class="p-3 text-center">Jenis Kelamin</th>
                        <th class="p-3 text-center">sim</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($data as $account)
                        <tr>
                            <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->name }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->nik }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->username }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->jabatan }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->level }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->nohp }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->area }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->kta }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->jenis_kelamin }}</td>
                            <td class="p-3 text-center uppercase">{{ $account->sim }}</td>
                            <td class="p-3 text-center">
                                <a href="{{ route('DataRgb.show', $account->id) }}"
                                    class="text-green-500 hover:underline">Detail</a>
                                <a href="{{ route('DataRgb.edit', $account->id) }}"
                                    class="text-blue-500 hover:underline">Edit</a>
                                <form action="{{ route('DataRgb.destroy', $account->id) }}" method="POST"
                                    class="inline-block ml-2">
                                    @csrf
                                    @method('DELETE')
                                    <button type="submit" class="text-red-500 hover:underline">Delete</button>
                                </form>
                            </td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
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
