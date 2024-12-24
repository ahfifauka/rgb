<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Umr;
use Illuminate\Http\Request;
use TCPDF;

class AreaRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Area::all();
        $lokasi = Umr::all();
        return view('admin.keuangan.rgb.area.index', compact('data', 'lokasi'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $data = $request->all();
        Area::create($data);
        return redirect()->route('Area.index')->with('success', 'Data Berhasil Disimpan');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $data = Area::findOrFail($id); // Ambil data berdasarkan ID
        $lokasi = Umr::all();
        return view('admin.keuangan.rgb.area.edit', compact('data', 'lokasi')); // Arahkan ke halaman edit dan kirim data

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Area::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('Area.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Area::findOrFail($id);
        $data->delete();
        return redirect()->route('Area.index')->with('success', 'Data Berhasil Dihapus');
    }

    public function cetak()
    {
        // Ambil data dari model Area
        $data = Area::all();

        // Inisialisasi TCPDF
        $pdf = new TCPDF('L', 'mm', 'A4'); // Mengatur mode landscape ('L')

        // Set header PDF
        $pdf->SetHeaderData('', 0, 'Laporan Area');

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Tambahkan halaman baru
        $pdf->AddPage();

        // Judul halaman
        $pdf->Cell(0, 10, 'Laporan Data Area', 0, 1, 'C');

        // Tambahkan header kolom
        $pdf->SetFont('helvetica', 'B', 8);
        $pdf->Cell(27, 10, 'Area', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Gaji', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Pajak', 1, 0, 'C');  // Pajak (PPN/Non-PPN)
        $pdf->Cell(40, 10, 'Alamat', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Lokasi', 1, 0, 'C');
        $pdf->Cell(40, 10, 'Tunjangan Transport', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Tunjangan Makan', 1, 0, 'C');
        $pdf->Cell(30, 10, 'Inventaris', 1, 0, 'C');
        $pdf->Cell(25, 10, 'Kontak', 1, 0, 'C');
        $pdf->Cell(20, 10, 'Bergabung', 1, 1, 'C');

        // Set font untuk data
        $pdf->SetFont('helvetica', '', 7);

        // Fungsi untuk format rupiah
        function formatRupiah($angka)
        {
            return 'Rp. ' . number_format($angka, 0, ',', '.');
        }

        // Menambahkan data ke tabel
        foreach ($data as $area) {
            $pdf->Cell(27, 10, $area->area, 1, 0, 'C');
            $pdf->Cell(25, 10, formatRupiah($area->gaji), 1, 0, 'C');
            $pdf->Cell(20, 10, $area->pajak == 'ppn' ? 'PPN' : 'Non-PPN', 1, 0, 'C');  // Menampilkan PPN atau Non-PPN
            $pdf->Cell(40, 10, $area->alamat, 1, 0, 'C');
            $pdf->Cell(20, 10, $area->lokasi, 1, 0, 'C');
            $pdf->Cell(40, 10, formatRupiah($area->tunj_trans), 1, 0, 'C');
            $pdf->Cell(30, 10, formatRupiah($area->tunj_makan), 1, 0, 'C');
            $pdf->Cell(30, 10, $area->inventaris, 1, 0, 'C');
            $pdf->Cell(25, 10, $area->kontak, 1, 0, 'C');
            $pdf->Cell(20, 10, $area->created_at->format('d-m-Y'), 1, 1, 'C'); // Format tanggal
        }

        // Output file PDF
        $pdf->Output('Laporan_Area.pdf', 'I');
    }
}
