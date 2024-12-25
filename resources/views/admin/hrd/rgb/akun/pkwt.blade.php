<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('PKWT RGB') }}
        </h2>
    </x-slot>

    <div class="p-6 rounded-lg w-full">
        <h3 class="text-lg font-bold mb-4">Form Input PKWT</h3>
        <form action="{{ route('pkwt.post') }}" method="POST">
            @csrf
            <!-- Input Nomor PKWT -->
            <div class="mb-4">
                <label for="no_surat" class="block text-white font-bold mb-2">Nomor PKWT</label>
                <input type="text" id="no_surat" name="no_surat" value="{{$nomorPkwt}}" class="w-full border-gray-300 text-black rounded-md shadow-sm focus:ring-indigo-500 focus:border-indigo-500" readonly required>
            </div>

            <!-- Input Name -->
            <div class="mb-4">
                <label for="name" class="block text-white font-bold mb-2">Name</label>
                <input type="text" id="name" name="name" class="w-full border-gray-300 rounded-md shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500" value="{{$user->name}}" readonly required>
            </div>

            <!-- Input NIK -->
            <div class="mb-4">
                <label for="nik" class="block text-white font-bold mb-2">NIK</label>
                <input type="text" id="nik" name="nik" class="w-full border-gray-300 rounded-md shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500" value="{{ $user->nik }}" readonly required>
            </div>

            <!-- Input Level -->
            <div class="mb-4">
                <label for="level" class="block text-white font-bold mb-2">Level</label>
                <input type="text" id="level" name="level" class="w-full border-gray-300 rounded-md shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500" value="{{ $user->level }}" readonly required>
            </div>

            <!-- Input Status -->
            <div class="mb-4">
                <label for="status" class="block text-white font-bold mb-2">Status</label>
                <input type="text" id="status" name="status" class="w-full border-gray-300 rounded-md shadow-sm text-black focus:ring-indigo-500 focus:border-indigo-500" value="PKWT" readonly required>
            </div>

            <!-- Input Area -->
            <div class="mb-4">
                <label for="area" class="block text-white font-bold mb-2">Area</label>
                <input type="text" id="area" name="area" class="w-full border-gray-300 rounded-md text-black shadow-sm focus:ring-indigo-500 focus:border-indigo-500" value="{{ $user->area }}" readonly required>
            </div>

            <!-- Submit Button -->
            <div class="text-right">
                <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded-md shadow-md text-black hover:bg-blue-600 focus:outline-none focus:ring-2 focus:ring-indigo-400">
                    Submit
                </button>
            </div>
        </form>
    </div>
    <div class="h-40"></div>
</x-app-layout>