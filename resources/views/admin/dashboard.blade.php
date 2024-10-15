<x-app-layout>
    <div>
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8 mt-8" style="padding: 10px 20px 10px 20px">
            <div class="bg-gray-800 overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 text-gray-200">
                    {{ __("Selamat datang dan Selamat bertugas !") }}
                </div>
            </div>
        </div>
    </div>
    <div class="p-6 w-full flex justify-center">
        @if(Auth::user()->jabatan == 'Administrasi' )
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
        @endif
    </div>
</x-app-layout>