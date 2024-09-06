<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('oprational RGB') }}
        </h2>
    </x-slot>

    <div class="flex flex-wrap gap-4 justify-center p-6 z-10">
        <!-- Card for Area -->
        <a href="{{route('AkunRgb.index')}}" class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div class="bg-blue-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-address-card fa-xs sm:fa-lg"></i> <!-- Map icon for Area -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">AKUN</h3>
        </a>

        <!-- Card for Penggajian PPN -->
        <a href="{{route('DataRgb.index')}}" class="block bg-gray-800 shadow-md rounded-lg p-2 sm:p-4 w-20 h-20 sm:w-60 sm:h-40 lg:w-60 lg:h-40 flex flex-col items-center text-center hover:shadow-lg transition duration-300 ease-in-out transform hover:scale-105">
            <div class="bg-green-500 text-white rounded-full p-1 sm:p-2 mb-2 sm:mb-4 flex items-center justify-center h-10 w-10 sm:h-12 sm:w-12">
                <i class="fas fa-users fa-xs sm:fa-lg"></i> <!-- Invoice icon for Penggajian PPN -->
            </div>
            <h3 class="text-xs sm:text-2xl font-semibold mb-1 sm:mb-2">ANGGOTA</h3>
        </a>
    </div>

</x-app-layout>