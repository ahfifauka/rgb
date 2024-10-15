<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('QR Code Scanner') }}
        </h2>
    </x-slot>

    <div class="p-6 flex justify-center flex-col items-center">
        <div id="reader" style="width: 300px; border-radius: 15px; overflow: hidden; border: 2px solid #4a5568;"></div>

        <!-- Dark-themed Modal -->
        <div id="myModal" class="fixed z-50 inset-0 overflow-y-auto hidden">
            <form action="{{ route('patroliU.store') }}" method="post" enctype="multipart/form-data">
                @csrf
                <div class="flex items-center justify-center h-full p-4">
                    <div class="bg-gray-800 rounded-lg p-6 w-full">
                        <h2 class="text-lg font-semibold text-white mb-4">Patroli</h2>
                        <input type="hidden" name="name" value="{{ Auth::user()->name }}">
                        <input type="hidden" name="nik" value="{{ Auth::user()->nik }}">
                        <input type="text" name="lokasi" id="qrDataInput" class="border rounded w-full p-2 mb-4 text-black" placeholder="Data from QR Code" readonly>

                        <!-- Input for Area Photo -->
                        <label class="text-white mb-2 block" for="areaPhoto">Area Photo:</label>
                        <input type="file" id="areaPhoto" name="foto_sekitar" class="border rounded w-full p-2 mb-4" accept="image/*">

                        <!-- Input for Person Photo -->
                        <label class="text-white mb-2 block" for="personPhoto">Person Photo:</label>
                        <input type="file" id="personPhoto" name="foto_anggota" class="border rounded w-full p-2 mb-4" accept="image/*">

                        <!-- Select option for safety status -->
                        <label class="text-white mb-2 block" for="safetyStatus">Safety Status:</label>
                        <select id="safetyStatus" name="situasi" class="border rounded w-full p-2 mb-4 text-black">
                            <option value="">Select Status</option>
                            <option value="Aman">Aman</option>
                            <option value="Tidak Aman">Tidak Aman</option>
                        </select>

                        <!-- Text area for details -->
                        <label class="text-white mb-2 block" for="details">Details:</label>
                        <textarea id="details" name="keterangan" class="border rounded w-full p-2 mb-4 text-black" rows="2" placeholder="Type your details here..."></textarea>

                        <div class="flex justify-between">
                            <button type="button" id="closeModalBtn" class="bg-red-500 text-white px-4 py-2 rounded">Close</button>
                            <button type="submit" class="bg-blue-500 text-white px-4 py-2 rounded">Simpan</button>
                        </div>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- Include HTML5 QR Code Library -->
    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>

    <script>
        const html5QrCode = new Html5Qrcode("reader");

        // Start scanning
        html5QrCode.start({ facingMode: "environment" }, { fps: 10, qrbox: 250 },
            qrCodeMessage => {
                // On successful scan
                document.getElementById('qrDataInput').value = qrCodeMessage; // Set the QR code message to the input field
                document.getElementById('myModal').classList.remove('hidden'); // Show the modal
            },
            errorMessage => {
                // Handle errors
                console.warn(`QR Code scan error: ${errorMessage}`);
            }
        ).catch(err => {
            console.error(`Failed to start scanning: ${err}`);
        });

        // Close the modal
        document.getElementById('closeModalBtn').onclick = function() {
            document.getElementById('myModal').classList.add('hidden'); // Hide the modal
        };

        // Automatically open camera for file input
        const openCameraForFileInput = (fileInput) => {
            fileInput.addEventListener('change', (event) => {
                const files = event.target.files;
                if (files.length > 0) {
                    const fileURL = URL.createObjectURL(files[0]);
                    const img = new Image();
                    img.src = fileURL;
                    img.onload = () => {
                        // Process the image if needed or show it
                        console.log('Image loaded:', img.src);
                    };
                }
            });
        };

        openCameraForFileInput(document.getElementById('areaPhoto'));
        openCameraForFileInput(document.getElementById('personPhoto'));
    </script>

    <style>
        /* Dark Theme Modal Styling */
        #myModal {
            background: rgba(0, 0, 0, 0.7);
            /* Dim background */
        }

        /* Modal content */
        .bg-gray-800 {
            background-color: #2d3748;
            /* Dark background for modal */
        }

        .text-white {
            color: #fff;
            /* White text color */
        }

        /* Input styles */
        input {
            border: 1px solid #4a5568;
            /* Darker border for input */
            background-color: #1a202c;
            /* Dark background for input */
            color: #fff;
            /* White text for input */
        }

        input::placeholder {
            color: #a0aec0;
            /* Light gray placeholder text */
        }

        /* Responsive modal styles */
        @media (max-width: 768px) {
            #myModal > div {
                width: 100%;
                /* Full width on mobile */
                height: 100%;
                /* Full height on mobile */
                border-radius: 0;
                /* Remove border radius on mobile */
            }
        }
    </style>
</x-app-layout>
