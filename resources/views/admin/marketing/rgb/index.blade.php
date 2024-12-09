<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Marketing') }}
        </h2>
    </x-slot>
    <div class="flex flex-wrap gap-4 justify-center p-6">
        <a href="{{ route('MarketingPlan.index') }}"
            class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div
                class="bg-blue-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-map-marker-alt fa-xs sm:fa-lg"></i> <!-- Map icon for Area -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">Marketing Plan</h3>
        </a>

        <a href="{{ route('TimeSchedule.index') }}"
            class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div
                class="bg-orange-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-calendar-alt fa-xs sm:fa-lg"></i> <!-- Map icon for Area -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">Time Schedule</h3>
        </a>

        <a href="{{ route('laporan.index') }}"
            class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div
                class="bg-green-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-file-alt fa-xs sm:fa-lg"></i> <!-- Map icon for Area -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">Laporan Harian</h3>
        </a>

        <a href="{{ route('laporan.index') }}"
            class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div
                class="bg-red-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-chart-line fa-xs sm:fa-lg"></i> <!-- Map icon for Area -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">Sales Existing</h3>
        </a>

        <!-- Card for Sales Exit -->
    </div>
</x-app-layout>