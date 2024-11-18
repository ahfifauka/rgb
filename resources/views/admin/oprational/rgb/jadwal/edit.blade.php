<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Edit Jadwal RGB') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="flex w-full justify-start mb-4">
            <a href="{{ route('jadwal.index') }}" class="bg-red-500 text-white rounded-md hover:bg-red-600 px-4 py-2">Kembali</a>
        </div>

        <div class="overflow-x-auto mt-6">
            <!-- Tampilkan nama dan NIK dari data -->
            <div class="flex justify-center text-center">
                <h2 class="text-2xl font-semibold text-white">Jadwal {{ $data->name }} <br> {{ $data->nik }}</h2>
            </div>

            <!-- Form untuk update jadwal -->
            <form action="{{ route('jadwal.update', $data->id) }}" method="POST">
                @csrf
                @method('PUT') <!-- Menandakan ini adalah request update -->

                <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-7 gap-4 mt-6">
                    @php
                    $currentMonth = now()->month;
                    $currentYear = now()->year;
                    $daysInMonth = \Carbon\Carbon::createFromDate($currentYear, $currentMonth, 1)->daysInMonth;
                    @endphp

                    @for ($day = 1; $day <= $daysInMonth; $day++)
                        <div class="border p-4 rounded-md flex items-center justify-between bg-white shadow-sm">
                        <div class="w-12">
                            <label for="day_{{ $day }}" class="text-gray-600 font-semibold">{{ $day }}</label>
                        </div>
                        <div class="flex-1">
                            <select name="day_{{ $day }}" id="day_{{ $day }}" class="w-full p-2 border rounded-md text-black">
                                <option value="P" {{ old('day_' . $day, $data->{'day_' . $day}) == 'P' ? 'selected' : '' }}>P</option>
                                <option value="M" {{ old('day_' . $day, $data->{'day_' . $day}) == 'M' ? 'selected' : '' }}>M</option>
                                <option value="ST" {{ old('day_' . $day, $data->{'day_' . $day}) == 'ST' ? 'selected' : '' }}>ST</option>
                                <option value="O" {{ old('day_' . $day, $data->{'day_' . $day}) == 'O' ? 'selected' : '' }}>O</option>
                            </select>
                        </div>
                </div>
                @endfor
        </div>

        <!-- Button untuk submit form -->
        <div class="flex justify-end w-full mt-6">
            <button type="submit" class="p-3 px-6 bg-green-500 hover:bg-green-700 text-white rounded-md">Update Data</button>
        </div>
        </form>
    </div>
    </div>

    <div class="h-40"></div>
</x-app-layout>