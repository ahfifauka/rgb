<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Patroli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Endroid\QrCode\Builder\Builder;
use Endroid\QrCode\Writer\PngWriter;
use Symfony\Component\HttpFoundation\Response;

class PatroliRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('jabatan', 'anggota')->get();
        return view('admin.oprational.rgb.patroli.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Area::all();
        return view('admin.oprational.rgb.patroli.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Validasi input dari form
        $validated = $request->validate([
            'area' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        // Ambil data dari form
        $area = $validated['area'];   // Area yang dipilih user
        $lokasi = $validated['lokasi'];   // Lokasi yang dimasukkan user

        // Gabungkan data untuk QR Code (misalnya "RGB.area.lokasi")
        $qrData = "RGB.$area.$lokasi";

        // Generate QR Code menggunakan Endroid
        $qrCode = Builder::create()
            ->writer(new PngWriter())  // Menggunakan PngWriter untuk menghasilkan gambar PNG
            ->data($qrData)           // Data yang digenerate untuk QR Code
            ->size(300)               // Ukuran QR code
            ->margin(10)              // Margin QR Code
            ->build();

        // Set nama file untuk QR Code
        $filename = 'qrcode-' . $area . '.png';

        // Menghasilkan dan mengirimkan file QR Code sebagai respons untuk diunduh
        return response($qrCode->getString(), 200, [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename="' . $filename . '"',
        ]);
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }
    public function detail($nik)
    {
        // Ambil semua data patroli dengan nik yang sama
        $patrolData = Patroli::where('nik', $nik)->get();

        // Kirim data ke tampilan
        return view('admin.oprational.rgb.patroli.detail', compact('patrolData', 'nik'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }
}
