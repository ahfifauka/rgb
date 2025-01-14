<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Buat Jadwal RGB') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <a href="{{ route('jadwal.index') }}" class="bg-red-500 text-white rounded-md hover:bg-red-600 px-4 py-2 mb-4">Kembali</a>

        <div class="mt-4">
            <label for="area" class="block text-gray-300 mb-2">Pilih Area</label>
            <select name="area" id="area" class="w-full rounded-md border-gray-300 bg-gray-200 text-black">
                <option disabled selected>Pilih Area</option>
                @foreach ($data as $item)
                    <option value="{{ $item->area }}">{{ $item->area }}</option>
                @endforeach
            </select>
        </div>

        <div id="user-data-container" class="mt-4 overflow-x-auto hidden">
            <!-- Data user dan input akan dimasukkan di sini oleh JavaScript -->
        </div>

        <!-- Tombol download template -->
        <button id="download-excel" class="bg-green-500 text-white rounded-md hover:bg-green-600 px-4 py-2 mt-4 hidden">
            <i class="fa-solid fa-download"></i> Template
        </button>

        <!-- Form upload template yang sudah diisi -->
        <div class="mt-4 hidden flex justify-center" id="upload-form-container">
            <form action="{{ route('upload.template') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <label for="file" class="block text-gray-300 mb-2">Upload File Template</label>
                <input type="file" name="file" id="file" accept=".xlsx" class="bg-gray-800 file-input h-10 rounded" style="padding: 5px 0 5px 5px">
                <button type="submit" class="bg-blue-500 text-white rounded-md hover:bg-blue-600 px-4 py-2">
                    Upload dan Simpan
                </button>
            </form>
        </div>
    </div>
    <div class="h-40"></div>

    <script src="https://cdn.jsdelivr.net/npm/xlsx/dist/xlsx.full.min.js"></script>
    <script>
        document.getElementById('area').addEventListener('change', function() {
            const selectedArea = this.value;
            const userDataContainer = document.getElementById('user-data-container');
            const downloadExcelBtn = document.getElementById('download-excel');
            const uploadFormContainer = document.getElementById('upload-form-container');

            if (selectedArea) {
                fetch(`/users-jadwal-by-area?area=${selectedArea}`)
                    .then(response => response.json())
                    .then(data => {
                        if (data.length) {
                            // Generate table for user data
                            userDataContainer.innerHTML = `
                                <table class="min-w-full bg-gray-800 text-white rounded-md">
                                    <thead>
                                        <tr>
                                            <th class="p-3 text-center">No</th>
                                            <th class="p-3 text-center">Nama</th>
                                            <th class="p-3 text-center">Nik</th>
                                            <th class="p-3 text-center">Area</th>
                                            ${Array.from({ length: 31 }, (_, i) => `<th class="p-3 text-center">${i + 1}</th>`).join('')}
                                        </tr>
                                    </thead>
                                    <tbody>
                                        ${data.map((user, index) => `
                                            <tr>
                                                <td class="p-3 text-center">${index + 1}</td>
                                                <td class="p-3 text-center">${user.name}</td>
                                                <td class="p-3 text-center">${user.nik}</td>
                                                <td class="p-3 text-center">${user.area}</td>
                                                ${Array.from({ length: 31 }, () => `
                                                    <td class="p-3 text-center">
                                                        <select name="status_${user.nik}[]" class="bg-gray-200 text-black">
                                                            <option value="P">P</option>
                                                            <option value="M">M</option>
                                                            <option value="ST">ST</option>
                                                            <option value="PM">PM</option>
                                                            <option value="MD">MD</option>
                                                            <option value="O">O</option>
                                                        </select>
                                                    </td>
                                                `).join('')}
                                            </tr>
                                        `).join('')}
                                    </tbody>
                                </table>
                            `;
                            downloadExcelBtn.classList.remove('hidden');
                            userDataContainer.classList.remove('hidden');
                            uploadFormContainer.classList.remove('hidden');
                        } else {
                            userDataContainer.innerHTML = '';
                            downloadExcelBtn.classList.add('hidden');
                            userDataContainer.classList.add('hidden');
                            uploadFormContainer.classList.add('hidden');
                        }
                    });
            } else {
                userDataContainer.innerHTML = '';
                downloadExcelBtn.classList.add('hidden');
                userDataContainer.classList.add('hidden');
                uploadFormContainer.classList.add('hidden');
            }
        });

        document.getElementById('download-excel').addEventListener('click', function() {
            const wb = XLSX.utils.book_new();
            const ws_data = [
                ["No", "Nama", "Nik", "Area", ...Array.from({ length: 31 }, (_, i) => i + 1)] // Header
            ];

            const rows = document.querySelectorAll("#user-data-container table tbody tr");
            rows.forEach((row, index) => {
                const rowData = [];
                const cells = row.querySelectorAll("td");
                cells.forEach(cell => {
                    rowData.push(cell.innerText || ""); // Set as empty if no value
                });
                ws_data.push(rowData);
            });

            const ws = XLSX.utils.aoa_to_sheet(ws_data);
            XLSX.utils.book_append_sheet(wb, ws, "Jadwal");
            XLSX.writeFile(wb, 'template.xlsx');
        });
    </script>
</x-app-layout>
