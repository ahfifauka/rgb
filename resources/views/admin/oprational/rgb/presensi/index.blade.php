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
        <div class="flex gap-2">
            <a href="{{ route('oprational.rgb') }}" class="bg-blue-500 text-white rounded-md hover:bg-blue-600"
                style="padding: 10px 10px 10px 10px"><i class="fas fa-file"></i> cetak</a>
            <a href="{{ route('oprational.rgb') }}" class="bg-blue-500 text-white rounded-md hover:bg-blue-600"
                style="padding: 10px 10px 10px 10px"> <i class="fas fa-eye"></i> detail</a>
            <a href="{{ route('oprational.rgb') }}" class="bg-red-500 text-white rounded-md hover:bg-red-600"
                style="padding: 10px 10px 10px 10px">Kembali</a>
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
                                <td class="p-3 text-center uppercase {{ $item['status'][$i] ?? 'B' }}">
                                    {{ $item['status'][$i] ?? 'B' }}</td>
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
</x-app-layout>
