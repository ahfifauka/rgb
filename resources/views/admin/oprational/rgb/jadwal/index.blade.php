<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Jadwal RGB') }}
        </h2>
    </x-slot>
    <div class="p-6">
        <div class="w-full flex justify-between">
            <div>
                <a href="{{ route('jadwal.create') }}"
                    class="bg-blue-500 text-white rounded-md hover:bg-blue-600 px-4 py-2 mb-4">Tambah</a>
                <a href="{{ route('oprational.rgb') }}"
                    class="bg-red-500 text-white rounded-md hover:bg-red-600 px-4 py-2 mb-4 ml-2">Kembali</a>
            </div>
            <div>
                <button type="button"
                    class="py-2 px-4 inline-flex items-center whitespace-nowrap gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                    x-data x-on:click="$dispatch('open-modal', 'add-jadwal-modal')">
                    Tools
                </button>
            </div>
        </div>

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
        <div class="overflow-x-auto mt-4">
            <table id="data-table" class="min-w-full bg-gray-800 text-white rounded-md">
                <thead>
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Nama</th>
                        <th class="p-3 text-center">Nik</th>
                        <th class="p-3 text-center">Area</th>
                        @for ($i = 1; $i < 31; $i++)
                            <th class="p-3 text-center">{{ $i }}</th>
                            @endfor
                            <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->name }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->nik }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->area }}</td>
                        @for ($i = 1; $i < 31; $i++)
                            <td class="p-3 text-center uppercase">{{ $item->$i }}</td>
                            @endfor
                            <td class="p-3 text-center actions">
                                <a href="{{ route('jadwal.edit', $item->id) }}" class="text-blue-500 hover:underline">Edit</a>
                            </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>

        </div>
    </div>
    <div class="h-40"></div>
    <x-modal name="add-jadwal-modal" focusable>
        <div class="container mx-auto p-4 bg-black rounded-lg shadow">
            <h2 class="text-lg font-bold text-white mb-4">Pilih tools</h2>
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-white mb-4">Cetak Presensi / Area</h2>
                <!-- Tombol 1 -->
                <form action="{{ route('laporan.jadwal') }}" method="post">
                    @csrf
                    <select name="area" id="area" class="text-black w-full rounded">
                        <option value=""> -- Pilih Area --</option>
                        @foreach($area as $a)
                        <option value="{{$a}}">{{$a}}</option>
                        @endforeach
                    </select>
                    <button type="submit" class="block mt-4 w-full bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600">Cetak</button>
                </form>
                <!-- Tombol 2 -->
                <hr class="text-white">
                <h2 class="text-lg font-bold text-white mb-4">Detail Presensi</h2>
                <a href="{{ route('detail.admin') }}"
                    class="mt-4 block w-full bg-blue-500 text-white px-4 py-2 rounded-md text-center hover:bg-blue-600">
                    Detail
                </a>
                <!-- Tombol 3 -->
            </div>
            <!-- Tombol Batal -->
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>
            </div>
        </div>
    </x-modal>
    <nav class="footer">
        <div class="container mx-auto p-4 flex justify-between">

            <!-- Home Icon -->
            <a href="{{ route('dashboard') }}" class="text-center flex justify-center items-center gap-2 flex-col nav-item"
                id="home">
                <i class="fas fa-home text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Home</span>
            </a>

            <!-- Keuangan Icon -->
            @if( Auth::user()->jabatan == 'administrasi' || Auth::user()->jabatan == 'direktur')
            <a href="{{ route('keuangan.index') }}"
                class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="keuangan">
                <i class="fas fa-wallet text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Keuangan</span>
            </a>
            @endif

            <!-- Operational Icon -->
            @if( Auth::user()->jabatan == 'oprational' || Auth::user()->jabatan == 'direktur')
            <a href="{{ route('oprational.index') }}"
                class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="operational">
                <i class="fas fa-cogs text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Operational</span>
            </a>
            @endif

            <!-- HRD Icon -->
            @if( Auth::user()->jabatan == 'hrd' || Auth::user()->jabatan == 'direktur')
            <a href="{{ route('hrd.index') }}" class="text-center flex justify-center items-center gap-2 flex-col nav-item"
                id="hrd">
                <i class="fas fa-users text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">HRD</span>
            </a>
            @endif

            <!-- Profile Icon -->
            @if( Auth::user()->jabatan == 'marketing' || Auth::user()->jabatan == 'direktur')
            <a href="{{ route('marketing.index') }}"
                class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="marketing">
                <i class="fas fa-building text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Marketing</span>
            </a>
            @endif

        </div>
    </nav>
    <script>
        document.getElementById('search-input').addEventListener('keyup', function() {
            const searchTerm = this.value.toLowerCase();
            const rows = document.querySelectorAll('#data-table tbody tr');

            rows.forEach(row => {
                const cells = row.querySelectorAll('td');
                let found = false;

                cells.forEach(cell => {
                    if (cell.textContent.toLowerCase().includes(searchTerm)) {
                        found = true;
                    }
                });

                if (found) {
                    row.style.display = ''; // Show row
                } else {
                    row.style.display = 'none'; // Hide row 
                }
            });
        });
    </script>
    <style>
        .footer {
            position: fixed;
            bottom: 0;
            left: 0;
            width: 100%;
            background-color: #202938;
            z-index: 109;
        }

        /* Mengatur agar tidak ada jarak diantara kolom */
        #data-table {
            border-collapse: collapse;
            /* Pastikan border dan sel tidak ada ruang antar */
            width: 100%;
            /* Agar kolom memiliki lebar yang tetap dan merata */
        }

        /* Mengatur header tabel agar lebih rapih */
        #data-table th,
        #data-table td {
            /* Padding yang sama untuk semua sel tabel */
            border: 1px solid #444;
            /* Border yang sama untuk semua sel */
            text-align: center;
            vertical-align: middle;
            /* Pastikan semua sel rata tengah */
            margin: 0;
            /* Menghilangkan margin pada sel */
        }

        /* Styling untuk header sticky */
        #data-table thead th {
            position: sticky;
            top: 0;
            background-color: #2d3748;
            z-index: 10;
            border: none;
            /* Menghapus border agar lebih bersih */
        }

        /* Styling untuk kolom sticky */
        #data-table td:first-child,
        #data-table th:first-child {
            position: sticky;
            left: 0;
            background-color: #2d3748;
            z-index: 103;
        }

        #data-table td:nth-child(2),
        #data-table th:nth-child(2) {
            position: sticky;
            left: 46px;
            /* Sesuaikan dengan lebar kolom pertama */
            background-color: #2d3748;
            z-index: 102;
        }

        #data-table td:nth-child(3),
        #data-table th:nth-child(3) {
            position: sticky;
            left: 113px;
            /* Sesuaikan dengan lebar kolom pertama dan kedua */
            background-color: #2d3748;
            z-index: 101;
        }

        #data-table td:nth-child(4),
        #data-table th:nth-child(4) {
            position: sticky;
            left: 241px;
            /* Sesuaikan dengan lebar kolom sebelumnya */
            background-color: #2d3748;
            z-index: 100;
        }

        /* Mengatur tampilan saat hover pada baris tabel */
        #data-table tbody tr:hover {
            background-color: #4a5568;
        }

        /* Styling untuk link di kolom Actions */
        #data-table .actions a {
            text-decoration: none;
            color: #3182ce;
            font-weight: bold;
        }

        #data-table .actions a:hover {
            text-decoration: underline;
            color: #2b6cb0;
        }

        @media screen and (max-width: 768px) {
            #data-table {
                display: block;
                overflow-x: auto;
                /* Scroll horizontal jika tabel terlalu lebar */
                white-space: nowrap;
                /* Menghindari teks terpotong */
            }

            /* Kolom menjadi lebih kecil dan tidak ada teks yang terpotong */
            #data-table th,
            #data-table td {
                font-size: 10px;
                /* Mengurangi ukuran font di perangkat kecil */
                padding: 8px 6px;
            }

            /* Mengatur padding untuk kolom actions */
            #data-table .actions {
                padding: 10px;
            }

            #data-table td:nth-child(1),
            #data-table th:nth-child(1) {
                display: none;
            }

            /* Tampilkan kolom dengan sticky untuk kolom pertama dan kedua pada layar kecil */

            #data-table td:nth-child(2),
            #data-table th:nth-child(2) {
                position: sticky;
                left: 0;
                z-index: 13;
            }

            #data-table td:nth-child(3),
            #data-table th:nth-child(3) {
                position: sticky;
                left: 38px;
                background-color: #2d3748;
                z-index: 12;
            }

            #data-table td:nth-child(4),
            #data-table th:nth-child(4) {
                position: sticky;
                left: 80px;
                background-color: #2d3748;
                z-index: 13;
            }
        }
    </style>
</x-app-layout>