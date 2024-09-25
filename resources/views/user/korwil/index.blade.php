<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Korwil') }}
        </h2>
    </x-slot>
    <div class="flex flex-wrap gap-4 justify-center p-6">
        <!-- Card for Marketing Plan -->
        <a href="{{ route('MarketingPlan.index') }}"
            class="block bg-gray-800 shadow-md rounded-lg p-4 w-full sm:w-64 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <!-- Icon -->
            <div class="bg-blue-500 text-white rounded-full p-3 mb-4">
                <i class="fas fa-calendar-check fa-2x"></i> <!-- Calendar Check icon for Marketing Plan -->
            </div>
            <!-- Title -->
            <h3 class="text-xl font-semibold uppercase mb-2">Presensi</h3>
        </a>

        <!-- Card for Time Schedule -->
        <a href="{{ route('TimeSchedule.index') }}"
            class="block bg-gray-800 shadow-md rounded-lg p-4 w-full sm:w-64 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <!-- Icon -->
            <div class="bg-purple-500 text-white rounded-full p-3 mb-4">
                <i class="fa-solid fa-user-shield fa-2x"></i>
            </div>
            <!-- Title -->
            <h3 class="text-xl font-semibold uppercase mb-2">Patroli</h3>
        </a>
    </div>
</x-app-layout>
