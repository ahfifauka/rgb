<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Penggajian RGB') }}
        </h2>
    </x-slot>
    <div class="p-6">
        <button type="button"
            class="py-2 px-4 inline-flex items-center gap-x-2 text-sm font-medium rounded-lg border border-transparent bg-blue-600 text-white hover:bg-blue-700 focus:outline-none focus:bg-blue-700 disabled:opacity-50 disabled:pointer-events-none"
            onclick="openModal()">
            Tambah
        </button>
        <a href="{{ route('keuangan.rgb') }}" class="ml-2 bg-red-500 text-white rounded-md hover:bg-red-600"
            style="padding: 10px 10px 10px 10px">Kembali</a>

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
                        <th class="p-3 text-center">Area</th>
                        <th class="p-3 text-center">File</th>
                        <th class="p-3 text-center">Periode</th>
                        <th class="p-3 text-center">Actions</th>
                    </tr>
                </thead>
                <tbody>
                    <!-- Sample Data -->
                    @foreach ($data as $item)
                    <tr>
                        <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->area }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->file }}</td>
                        <td class="p-3 text-center uppercase">{{ $item->created_at }}</td>
                        <td class="p-3 text-center">
                            <a href="{{ route('Area.edit', $item->id) }}"
                                class="text-blue-500 hover:underline">Edit</a>
                            <form action="{{ route('Area.destroy', $item->id) }}" method="POST"
                                class="inline-block ml-2">
                                @csrf
                                @method('DELETE')
                                <button type="submit" class="text-red-500 hover:underline">Delete</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
    <div id="customModal"
        class="hidden fixed inset-0 z-50 flex items-center justify-center bg-black bg-opacity-50 transition-opacity ease-out duration-300 opacity-0 pointer-events-none">
        <div class="bg-gray-800 rounded-lg shadow-lg max-w-lg w-full transform transition-all duration-500 scale-95 opacity-0"
            id="modalContent">
            <!-- Modal header -->
            <div class="flex justify-between items-center py-3 px-4 border-b border-gray-600">
                <h3 class="font-bold text-white text-lg">
                    Pilih Status Penggajian
                </h3>
                <button type="button"
                    class="inline-flex justify-center items-center gap-x-2 rounded-full border border-transparent bg-gray-100 text-gray-800 hover:bg-gray-200 focus:outline-none focus:bg-gray-200"
                    onclick="closeModal()">
                    <svg class="shrink-0 size-4" xmlns="http://www.w3.org/2000/svg" width="24" height="24"
                        viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round"
                        stroke-linejoin="round">
                        <path d="M18 6 6 18"></path>
                        <path d="m6 6 12 12"></path>
                    </svg>
                </button>
            </div>

            <!-- Modal content -->
            <div class="p-4 space-y-4">
                <!-- Card PPN -->
                <a href="{{ route('ppn.penggajian') }}"
                    class="block bg-blue-700 p-4 rounded-lg shadow-md hover:bg-blue-600 transition ease-in-out duration-200">
                    <h4 class="text-lg font-semibold text-white">PPN</h4>
                    </p>
                </a>

                <!-- Card NON PPN -->
                <a href="{{ route('non.penggajian') }}"
                    class="block bg-red-700 p-4 rounded-lg shadow-md hover:bg-red-600 transition ease-in-out duration-200">
                    <h4 class="text-lg font-semibold text-white">NON PPN</h4>
                </a>
            </div>
        </div>
    </div>
    <div class="h-20"></div>
    <!-- Add JavaScript to handle modal open/close with animation -->
    <script>
        function openModal() {
            const modal = document.getElementById('customModal');
            const modalContent = document.getElementById('modalContent');

            // Show the modal background
            modal.classList.remove('hidden');
            setTimeout(() => {
                modal.classList.remove('opacity-0', 'pointer-events-none');
                modal.classList.add('opacity-100');
            }, 10); // Delay to trigger CSS transition

            // Animate the modal content (scale up and fade in)
            setTimeout(() => {
                modalContent.classList.remove('scale-95', 'opacity-0');
                modalContent.classList.add('scale-100', 'opacity-100');
            }, 10);
        }

        function closeModal() {
            const modal = document.getElementById('customModal');
            const modalContent = document.getElementById('modalContent');

            // Animate the modal content (scale down and fade out)
            modalContent.classList.remove('scale-100', 'opacity-100');
            modalContent.classList.add('scale-95', 'opacity-0');

            // Hide the modal background after animation completes
            setTimeout(() => {
                modal.classList.add('opacity-0', 'pointer-events-none');
                modal.classList.remove('opacity-100');
                setTimeout(() => {
                    modal.classList.add('hidden');
                }, 300); // Time for the background to fade out
            }, 300); // Time for the modal content animation
        }
    </script>
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