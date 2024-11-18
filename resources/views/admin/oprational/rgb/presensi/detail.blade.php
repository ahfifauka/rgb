<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Detail Presensi: ') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="flex mb-4">
            <a href="{{ route('presensi.index') }}"
                class="bg-red-500 text-white rounded-md hover:bg-red-600 px-4 py-2">Kembali</a>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-gray-800 text-white rounded-md">
                <thead>
                    <tr>
                        <th class="p-3 text-center">No</th>
                        <th class="p-3 text-center">Nama</th>
                        <th class="p-3 text-center">Nik</th>
                        <th class="p-3 text-center">Lokasi</th>
                        <th class="p-3 text-center">Foto</th>
                        <th class="p-3 text-center">Area</th>
                        <th class="p-3 text-center">Divisi</th>
                        <th class="p-3 text-center">Sesi</th>
                        <th class="p-3 text-center">Keterangan Masuk</th>
                        <th class="p-3 text-center">Keterangan Pulang</th>

                        <!-- Tambahkan kolom lain sesuai kebutuhan -->
                    </tr>
                </thead>
                <tbody>
                    @foreach ($data as $item)
                    <tr>
                        <td class="p-3 text-center uppercase">{{ $loop->iteration }}</td>
                        <td class="p-3 text-center">{{ $item->name }}</td>
                        <td class="p-3 text-center">{{ $item->nik }}</td>
                        <td class="p-3 text-center">
                            <iframe
                                class="flex m-auto"
                                width="200"
                                height="100"
                                style="border:0;"
                                loading="lazy"
                                allowfullscreen
                                src="{{$item->location}}&output=embed">
                            </iframe>
                        </td>
                        <td class="p-3 text-center">
                            <a href="{{ asset($item->image) }}" onclick="openLightbox(event, '{{ asset($item->image) }}')">
                                <img src="{{ asset($item->image) }}" alt="Image" class="rounded flex m-auto" style="width: 140px; cursor: pointer;">
                            </a>
                        </td>
                        <td class="p-3 text-center">{{ $item->area }}</td>
                        <td class="p-3 text-center">{{ $item->bagian }}</td>
                        <td class="p-3 text-center">{{ $item->sesi }}</td>
                        <td class="p-3 text-center whitespace-nowrap">{{ $item->ket1 }} <br> {{$item->created_at}}</td>
                        <td class="p-3 text-center whitespace-nowrap">{{ $item->ket2 }} <br> {{$item->updated_at}}</td>
                        <!-- Tambahkan data lain sesuai kebutuhan -->
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
        <div id="lightbox" style="display: none; position: fixed; top: 0; left: 0; width: 100%; height: 100%; background: rgba(0, 0, 0, 0.8); z-index: 1000; justify-content: center; align-items: center;">
            <img id="lightbox-image" src="" alt="Large Image" style="max-width: 90%; max-height: 90%;">
            <span onclick="closeLightbox()" style="position: absolute; top: 20px; right: 20px; color: white; font-size: 24px; cursor: pointer;">&times;</span>
        </div>

    </div>
    <div class="h-40"></div>
    <script>
        function openLightbox(event, imageUrl) {
            event.preventDefault(); // Prevent default link behavior
            var lightbox = document.getElementById('lightbox');
            var lightboxImage = document.getElementById('lightbox-image');
            lightboxImage.src = imageUrl;
            lightbox.style.display = 'flex'; // Show lightbox
        }

        function closeLightbox() {
            var lightbox = document.getElementById('lightbox');
            lightbox.style.display = 'none'; // Hide lightbox
        }
    </script>
</x-app-layout>