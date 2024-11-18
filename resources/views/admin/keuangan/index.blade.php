<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Keuangan') }}
        </h2>
    </x-slot>
    <div class="flex flex-wrap gap-4 justify-center p-6 z-10">
        <!-- Card for RGB -->
        <a href="{{ route('keuangan.rgb') }}"
            class="block bg-gray-800 shadow-md rounded-lg p-4 w-full sm:w-64 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <!-- Icon -->
            <div class="bg-blue-500 text-white rounded-full p-3 mb-4">
                <i class="fas fa-shield-alt fa-2x"></i> <!-- Shield icon for RGB -->
            </div>
            <!-- Title -->
            <h3 class="text-xl font-semibold mb-2">RGB</h3>
            <!-- Description -->
            <!-- <p class="text-gray-500">Real-time Graphics Buffer</p> -->
        </a>

        <!-- Card for RBM -->
        <a href="{{ route('keuangan.rbm') }}"
            class="block bg-gray-800 shadow-md rounded-lg p-4 w-full sm:w-64 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <!-- Icon -->
            <div class="bg-green-500 text-white rounded-full p-3 mb-4">
                <i class="fas fa-broom fa-2x"></i> <!-- Broom icon for RBM -->
            </div>
            <!-- Title -->
            <h3 class="text-xl font-semibold mb-2">RBM</h3>
            <!-- Description -->
            <!-- <p class="text-gray-500">Real-time Building Maintenance</p> -->
        </a>
        <a href="{{ route('umr.index') }}"
            class="block bg-gray-800 shadow-md rounded-lg p-4 w-full sm:w-64 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <!-- Icon -->
            <div class="bg-green-500 text-white rounded-full p-3 mb-4">
                <i class="fas fa-money-bill fa-2x"></i> <!-- Broom icon for RBM -->
            </div>
            <!-- Title -->
            <h3 class="text-xl font-semibold mb-2">UMR</h3>
            <!-- Description -->
            <p class="text-gray-500">atur keuangan tiap daerah</p>
        </a>
    </div>
    </div>
    <div class="h-20"></div>
</x-app-layout>