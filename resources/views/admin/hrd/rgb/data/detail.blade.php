<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-200 leading-tight">
            {{ __('Data Akun RGB') }}
        </h2>
    </x-slot>

    <div class="p-6">
        <div class="container mx-auto">
            <div class="grid grid-cols-1 md:grid-cols-3 gap-6">
                <!-- Sidebar Foto Profil -->
                <div class="bg-gray-800 shadow rounded-lg p-4">
                    <div class="text-center">
                        <img src="{{ asset('storage/' . $user->foto) }}" alt="Profile Picture"
                            class="rounded-full w-32 h-32 mb-4 mx-auto">
                        <h3 class="text-xl font-semibold">{{ $user->name }}</h3>
                        <p class="text-gray-600">{{ $user->jabatan }} | {{ $user->role }}</p>
                    </div>
                </div>

                <!-- Main Profile Content -->
                <div class="md:col-span-2">
                    <div class="bg-gray-800 shadow rounded-lg p-6">
                        <h4 class="text-lg font-semibold mb-4">Informasi Pribadi</h4>
                        <table class="w-full text-white table-auto">
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2"><strong>NIK:</strong></td>
                                    <td class="px-4 py-2">{{ $user->nik }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Email:</strong></td>
                                    <td class="px-4 py-2">{{ $user->email }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Username:</strong></td>
                                    <td class="px-4 py-2">{{ $user->username }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>No HP:</strong></td>
                                    <td class="px-4 py-2">{{ $user->nohp }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Alamat:</strong></td>
                                    <td class="px-4 py-2">{{ $user->alamat }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Golongan Darah:</strong></td>
                                    <td class="px-4 py-2">{{ $user->golongan_darah }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Agama:</strong></td>
                                    <td class="px-4 py-2">{{ $user->agama }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Jenis Kelamin:</strong></td>
                                    <td class="px-4 py-2">{{ $user->jenis_kelamin }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Status Pernikahan:</strong></td>
                                    <td class="px-4 py-2">{{ $user->status }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Area:</strong></td>
                                    <td class="px-4 py-2">{{ $user->area }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4 class="text-lg font-semibold mt-6 mb-4">Informasi Keluarga</h4>
                        <table class="w-full text-white table-auto">
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2"><strong>Nama Pasangan:</strong></td>
                                    <td class="px-4 py-2">{{ $user->name_pasangan }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Nama Anak:</strong></td>
                                    <td class="px-4 py-2">{{ $user->name_anak }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4 class="text-lg font-semibold mt-6 mb-4">Dokumen Penting</h4>
                        <table class="min-w-full text-white table-auto">
                            <tbody>
                                <tr>
                                    <td class="px-4 py-2"><strong>KTP:</strong></td>
                                    <td class="px-4 py-2">
                                        @if ($user->ktp)
                                            <i class="fas fa-check text-green-500"></i> <!-- Ikon ceklis -->
                                        @else
                                            <i class="fas fa-times text-red-500"></i> <!-- Ikon "X" -->
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>SKCK:</strong></td>
                                    <td class="px-4 py-2">
                                        @if ($user->skck)
                                            <i class="fas fa-check text-green-500"></i>
                                        @else
                                            <i class="fas fa-times text-red-500"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>KK:</strong></td>
                                    <td class="px-4 py-2">
                                        @if ($user->kk)
                                            <i class="fas fa-check text-green-500"></i>
                                        @else
                                            <i class="fas fa-times text-red-500"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Surat Lamaran:</strong></td>
                                    <td class="px-4 py-2">
                                        @if ($user->lamaran)
                                            <i class="fas fa-check text-green-500"></i>
                                        @else
                                            <i class="fas fa-times text-red-500"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Surat Sehat:</strong></td>
                                    <td class="px-4 py-2">
                                        @if ($user->surat_sehat)
                                            <i class="fas fa-check text-green-500"></i>
                                        @else
                                            <i class="fas fa-times text-red-500"></i>
                                        @endif
                                    </td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>Ijazah:</strong></td>
                                    <td class="px-4 py-2">{{ $user->ijazah }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>SIM:</strong></td>
                                    <td class="px-4 py-2">{{ $user->sim }}</td>
                                </tr>
                                <tr>
                                    <td class="px-4 py-2"><strong>KTA:</strong></td>
                                    <td class="px-4 py-2">{{ $user->kta }}</td>
                                </tr>
                            </tbody>
                        </table>

                        <h4 class="text-lg font-semibold mt-6 mb-4">Tanggal Pembuatan Akun</h4>
                        <p>{{ $user->created_at->format('d M Y') }}</p>

                        <div class="flex mt-4 justify-end">
                            <a href="{{ route('DataRgb.index') }}"
                                class="ml-2 bg-red-500 text-white px-4 py-2 rounded-md hover:bg-red-600">Kembali</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <div class="h-24"></div>
</x-app-layout>
