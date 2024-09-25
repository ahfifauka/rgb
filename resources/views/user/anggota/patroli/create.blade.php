<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Patroli') }}
        </h2>
    </x-slot>

    <div class="p-6 flex justify-center flex-col items-center">
        <div id="qr-reader" style="width: 100%; max-width: 600px; height: auto;"></div>
    </div>

    <!-- Modal -->
    <div id="qrModal"
        class="modal fixed inset-0 flex items-center justify-center hidden opacity-0 transition-opacity duration-300">
        <div class="modal-content bg-white rounded shadow-lg p-6 scale-75 transition-transform duration-300">
            <span id="modal-close" class="cursor-pointer text-red-500 float-right">&times;</span>
            <h3 class="text-lg font-semibold">Scanned QR Code</h3>
            <p id="qr-code-data" class="mt-4"></p>
        </div>
    </div>

    <script src="https://unpkg.com/html5-qrcode@2.3.8/html5-qrcode.min.js"></script>
    <script>
        document.addEventListener("DOMContentLoaded", () => {
            const html5QrCode = new Html5Qrcode("qr-reader");

            async function startScanner() {
                const constraints = {
                    facingMode: "environment"
                };

                try {
                    await html5QrCode.start(
                        constraints, {
                            fps: 10,
                            qrbox: {
                                width: 250,
                                height: 250
                            } // Adjust QR box size
                        },
                        (decodedText, decodedResult) => {
                            console.log(`QR Code detected: ${decodedText}`);
                            showModal(decodedText); // Show modal with the scanned data
                        },
                        (errorMessage) => {
                            console.warn(`QR Code no longer in front of camera. ${errorMessage}`);
                        }
                    );
                } catch (err) {
                    console.error(`Failed to start QR Code scanner: ${err}`);
                }
            }

            function showModal(qrData) {
                // Display the scanned QR code data in the modal
                document.getElementById("qr-code-data").innerText = qrData;

                const modal = document.getElementById("qrModal");
                modal.classList.remove("hidden");
                modal.classList.remove("opacity-0");
                modal.classList.add("opacity-100");
                modal.querySelector('.modal-content').classList.remove("scale-75");
                modal.querySelector('.modal-content').classList.add("scale-100");
            }

            document.getElementById("modal-close").addEventListener("click", () => {
                const modal = document.getElementById("qrModal");
                modal.classList.add("opacity-0");
                modal.querySelector('.modal-content').classList.add("scale-75");

                setTimeout(() => {
                    modal.classList.add("hidden");
                    html5QrCode.stop(); // Stop the scanner when closing the modal
                    startScanner(); // Restart scanner after closing modal
                }, 300); // Match the duration of the transition
            });

            startScanner(); // Start the scanner when the page loads
        });
    </script>

    <style>
        /* Mobile-friendly styles */
        #qr-reader {
            height: auto;
        }

        .modal {
            display: none;
            /* Initially hide modal */
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background-color: rgba(0, 0, 0, 0.5);
            justify-content: center;
            align-items: center;
        }

        .modal-content {
            background: white;
            padding: 20px;
            border-radius: 10px;
            box-shadow: 0 2px 10px rgba(0, 0, 0, 0.1);
        }
    </style>
</x-app-layout>
