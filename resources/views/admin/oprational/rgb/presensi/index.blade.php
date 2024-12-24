<style>
    .TK {
        color: red;
    }

    .M {
        color: green;
    }

    .B {
        color: gray;
    }
</style>

<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Presensi RGB') }}
        </h2>
    </x-slot>
    <div class="p-6">
        <div class="w-full flex justify-between">
            <div>
                <a href="{{ route('oprational.rgb') }}" class="bg-red-500 text-white rounded-md hover:bg-red-600"
                    style="padding: 10px 10px 10px 10px">Kembali</a>
            </div>
            <div>
                <button type="button"
                    class="py-2 px-4 inline-flex items-center whitespace-nowrap gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
                    x-data x-on:click="$dispatch('open-modal', 'add-presensi-modal')">
                    Tools
                </button>
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
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Nama</th>
                        <th class="p-3 text-center">Nik</th>
                        <th class="p-3 text-center">Area</th>
                        @for ($i = 1; $i <= 31; $i++)
                            <th class="p-3 text-center">{{ $i }}</th>
                            @endfor
                            <th class="p-3 text-center M">M</th>
                            <th class="p-3 text-center TK">TK</th>
                            <th class="p-3 text-center B">B</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                        <td class="p-3 text-center uppercase">{{ $item['name'] }}</td>
                        <td class="p-3 text-center uppercase">{{ $item['nik'] }}</td>
                        <td class="p-3 text-center uppercase">{{ $item['area'] }}</td>
                        @for ($i = 1; $i <= 31; $i++)
                            <td class="p-3 text-center uppercase ">

                            @if($item['timestamps'][$i])
                            @if($item['timestamps'][$i]['created_at'] === $item['timestamps'][$i]['updated_at'])
                            <p class="text-green-500">{{ $item['timestamps'][$i]['created_at'] }}</p>
                            @else
                            <p class="text-green-500">{{ $item['timestamps'][$i]['created_at'] }}</p>
                            <p class="text-blue-500">{{ $item['timestamps'][$i]['updated_at'] }}</p>
                            @endif
                            @else
                            <div class="{{ $item['status'][$i] ?? 'B' }}">{{ $item['status'][$i] ?? 'B' }}</div>
                            @endif
                            @endfor
                            <td class="p-3 text-center uppercase">
                                {{ $item['counts']['M'] }}
                            </td>
                            <td class="p-3 text-center uppercase">
                                {{ $item['counts']['TK'] }}
                            </td>
                            <td class="p-3 text-center uppercase">
                                {{ $item['counts']['B'] }}
                            </td>

                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div class="h-40"></div>
    <x-modal name="add-presensi-modal" focusable>
        <div class="container mx-auto p-4 bg-black rounded-lg shadow">
            <h2 class="text-lg font-bold text-white mb-4">Pilih tools</h2>
            <div class="space-y-3">
                <h2 class="text-lg font-bold text-white mb-4">Cetak Presensi / Area</h2>
                <!-- Tombol 1 -->
                <form action="{{ route('laporan.presensi') }}" method="post">
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
</x-app-layout>