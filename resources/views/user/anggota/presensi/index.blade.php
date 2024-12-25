<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Presensi') }}
        </h2>
    </x-slot>

    <div class="p-6 flex justify-center flex-col items-center">
        <div class="relative w-full max-w-xs">
            <!-- Video stream for capturing photo -->
            <video id="video" class="w-full rounded-md" autoplay></video>

            <!-- Button to take photo -->
            <button class="takePhoto mt-4 bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full">
                Take Photo
            </button>

            <!-- Image preview (hidden initially) -->
            <img id="capturedImage" alt="Captured Photo" class="mt-4 w-full rounded-md" style="display:none;" />
        </div>

        <form method="POST" action="{{ route('presensi.store') }}" enctype="multipart/form-data"
            class="w-full max-w-xs mt-6">
            @csrf
            <!-- Hidden input to store captured image -->
            <input type="hidden" id="capturedImageInput" name="captured_image">

            <!-- Input to store formatted location as Google Maps link -->
            <input type="hidden" style="color: black;" id="locationInput" name="location">
            <input type="hidden" style="color: black;" name="name" value="{{ Auth::user()->name }}">
            <input type="hidden" style="color: black;" name="nik" value="{{ Auth::user()->nik }}">
            <input type="hidden" style="color: black;" name="area" value="{{ Auth::user()->area }}">
            <input type="hidden" style="color: black;" name="bagian" value="rumah">
            <input type="hidden" style="color: black;" name="sesi" id="sesi" value="{{ $jadwal ? $jadwal->{now()->day} : '' }}">
            <div class="mt-2">
                <input type="hidden" class="w-full rounded text-black" name="ket1" id="ket1" readonly>
            </div>

            <!-- Submit button for form -->
            <button type="submit" id="submitButton"
                class="bg-green-500 hover:bg-green-600 text-white font-bold py-2 px-4 rounded w-full mt-4">
                Submit
            </button>
            <button type="button"
                class="bg-blue-500 hover:bg-blue-600 text-white font-bold py-2 px-4 rounded w-full mt-4"
                x-data x-on:click="$dispatch('open-modal', 'add-area-modal')">
                Izin
            </button>
            <div id="coordinatesDisplay w-full p-4" class="mt-4">
                <p>Coordinates:</p>
                <p>Latitude: <span id="latitudeInput">N/A</span></p>
                <p>Longitude: <span id="longitudeInput">N/A</span></p>
                <p>Location Name: <span id="locationName">Fetching...</span></p>
                <p>
                    <a id="googleMapsLink" href="#" target="_blank" class="text-blue-500 underline"
                        style="display:none;">View on Google Maps</a>
                </p>
            </div>
        </form>
    </div>
    <x-modal name="add-area-modal" focusable>
        <form action="{{ route('izin.anggota.store') }}" method="POST" class="p-6" enctype="multipart/form-data">
            @csrf
            <h2 class=" text-lg font-bold text-gray-900 dark:text-gray-100">
                Form Izin
            </h2>
            <input type="hidden" name="name2" id="name2" value="{{ Auth::user()->name }}" required readonly>
            <input type="hidden" name="location2" id="locationInput2" required readonly>
            <input type="hidden" name="nik2" id="nik2" value="{{ Auth::user()->nik }}" required readonly>
            <input type="hidden" name="area2" id="area2" value="{{ Auth::user()->area }}" required readonly>
            <input type="hidden" name="bagian2" id="bagian2" value="rumah" required readonly>
            <input type="hidden" name="sesi2" id="sesi2" value="{{ $jadwal ? $jadwal->{now()->day} : '' }}" required readonly>
            <div class="mt-4">
                <label for="keterangan" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Keterangan</label>
                <select name="keterangan" id="keterangan" class="w-full mt-1 px-3 py-2 border rounded-md text-black">
                    <option disabled selected>-- Pilih Izin --</option>
                    <option value="Sakit">Sakit</option>
                    <option value="Izin">Izin</option>
                </select>
            </div>
            <div class="mt-4">
                <label for="file" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Upload Lampiran ( Optional )</label>
                <input type="file" name="file" id="file" class="w-full mt-1 px-3 py-2 border rounded-md text-white">
            </div>
            <div class="mt-4">
                <label for="keterangan2" class="block text-sm font-medium text-gray-700 dark:text-gray-400">Lama Izin ( Jika sakit sesuai surat sakit )</label>
                <input type="number" name="keterangan2" id="keterangan2" class="w-full mt-1 px-3 py-2 border rounded-md text-black" required>
            </div>
            <div class="mt-6 flex justify-end">
                <x-secondary-button x-on:click="$dispatch('close')">
                    Batal
                </x-secondary-button>
                <x-primary-button class="ml-3">
                    Simpan
                </x-primary-button>
            </div>
        </form>
    </x-modal>
    <div class="h-20"></div>
    <nav class="fixed bottom-0 left-0 right-0 bg-gray-800 shadow-lg ">
        <div class="container mx-auto p-4 flex justify-between">

            <!-- Home Icon -->
            <a href="{{ route('dashboard') }}" class="text-center flex justify-center items-center gap-2 flex-col nav-item"
                id="home">
                <i class="fas fa-home text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Home</span>
            </a>

            <!-- Keuangan Icon -->
            <a href="{{ route('anggota.index') }}"
                class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="keuangan">
                <i class="fa-solid fa-users text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Anggota</span>
            </a>

            <!-- Operational Icon -->
            <a href="{{ route('danru.index') }}"
                class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="operational">
                <i class="fa-solid fa-user-tie text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Danru</span>
            </a>

            <a href="{{ route('korwil.index') }}"
                class="text-center flex justify-center items-center gap-2 flex-col nav-item" id="operational">
                <i class="fa-solid fa-car text-2xl text-gray-300"></i>
                <span class="text-sm text-gray-300">Korwil</span>
            </a>

        </div>
    </nav>

    <script>
        const video = document.getElementById("video");
        const takePhotoButton = document.querySelector(".takePhoto");
        const capturedImage = document.getElementById("capturedImage");
        const capturedImageInput = document.getElementById("capturedImageInput");
        const locationInput = document.getElementById("locationInput");
        const locationInput2 = document.getElementById("locationInput2");
        const latitudeInput = document.getElementById("latitudeInput");
        const longitudeInput = document.getElementById("longitudeInput");
        const googleMapsLink = document.getElementById("googleMapsLink");
        const submitButton = document.getElementById("submitButton");
        const ketInput = document.getElementById("ket1");

        // Automatically start front camera when page loads
        const constraints = {
            video: {
                facingMode: "user" // Start with front camera for mobile
            },
        };

        navigator.mediaDevices.getUserMedia(constraints).then(handleSuccess).catch(handleError);

        function handleSuccess(stream) {
            video.srcObject = stream;
        }

        function handleError(error) {
            console.error("Error: ", error);
            alert("Unable to access the camera. Please check your permissions.");
        }

        // Button to take a photo from the video stream
        takePhotoButton.onclick = function() {
            const canvas = document.createElement("canvas");
            const context = canvas.getContext("2d");
            canvas.width = video.videoWidth;
            canvas.height = video.videoHeight;
            context.drawImage(video, 0, 0, canvas.width, canvas.height);
            const dataURL = canvas.toDataURL('image/png');
            capturedImage.src = dataURL;
            capturedImage.style.display = "block";
            capturedImageInput.value = dataURL;
        };

        // Function to check time and show/hide button and update keterangan
        function checkTimeAndLateStatus() {
            const currentDate = new Date();
            const currentHour = currentDate.getHours();
            let keterangan = "Masuk Terlambat"; // Default

            if ((currentHour >= 6 && currentHour < 8) ||
                (currentHour >= 12 && currentHour < 13) ||
                (currentHour >= 18 && currentHour < 20)) {
                keterangan = "Masuk";
            }

            // Selalu tampilkan tombol submit
            submitButton.style.display = 'block';

            // Set keterangan
            ketInput.value = keterangan;
        }

        // Automatically get current location when the page loads
        window.onload = function() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(async position => {
                    const lat = position.coords.latitude;
                    const lng = position.coords.longitude;

                    // Create Google Maps link with a marker
                    const locationLink = `https://www.google.com/maps/?q=${lat},${lng}`;
                    locationInput.value = locationLink; // Store link in the input
                    locationInput2.value = locationLink; // Store link in the input
                    latitudeInput.textContent = lat.toFixed(6); // Display latitude
                    longitudeInput.textContent = lng.toFixed(6); // Display longitude
                    googleMapsLink.href = locationLink; // Set link for viewing on Google Maps
                    googleMapsLink.style.display = "block"; // Show the link

                    // Call Nominatim API to get the location name
                    try {
                        const nominatimURL = `https://nominatim.openstreetmap.org/reverse?format=jsonv2&lat=${lat}&lon=${lng}`;
                        const response = await fetch(nominatimURL);
                        const data = await response.json();

                        if (data && data.display_name) {
                            const locationName = data.display_name;
                            document.getElementById('locationName').textContent = locationName; // Display location name
                        } else {
                            console.error("Nominatim API error: ", data);
                            alert("Unable to fetch location name.");
                        }
                    } catch (error) {
                        console.error("Error fetching location name: ", error);
                        alert("Error retrieving location name.");
                    }
                }, error => {
                    console.error("Geolocation error: ", error);
                    alert("Unable to retrieve your location. Please check your location settings.");
                });
            } else {
                alert("Geolocation is not supported by this browser.");
            }

            checkTimeAndLateStatus(); // Check time on load
        };
    </script>
</x-app-layout>