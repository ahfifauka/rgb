<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Oprational RGB') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 justify-center p-6 z-10">
        <!-- Card for Area -->
        <a href="#" class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div class="bg-blue-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-hand fa-xs sm:fa-lg"></i> <!-- Map icon for Area -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">PRESENSI</h3>
        </a>

        <!-- Card for Penggajian PPN -->
        <a href="#" class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div class="bg-green-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-landmark fa-xs sm:fa-lg"></i> <!-- Invoice icon for Penggajian PPN -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">PATROLI</h3>
        </a>

        <!-- Card for Penggajian Non PPN -->
        <a href="#" class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div class="bg-red-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-calendar-days fa-xs sm:fa-lg"></i> <!-- Money icon for Penggajian Non PPN -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">JADWAL</h3>
        </a>

        <!-- Card for Kas -->
        <a href="#" class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div class="bg-yellow-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-briefcase fa-xs sm:fa-lg"></i> <!-- Wallet icon for Kas -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">INVENTARIS</h3>
        </a>

        <!-- Card for Invoice -->
        <a href="#" class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div class="bg-purple-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-file fa-xs sm:fa-lg"></i> <!-- File Invoice icon for Invoice -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">LAPBUL</h3>
        </a>
    </div>

</x-app-layout>