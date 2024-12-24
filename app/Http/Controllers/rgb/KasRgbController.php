<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use Illuminate\Http\Request;
use TCPDF;
use Carbon\Carbon;

class KasRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    // KasController.php

    public function index()
    {
        $lastRecord = Kas::oldest()->first(); // Ambil record terbaru
        $existingSaldo = $lastRecord ? $lastRecord->saldo : 0;
        $pemasukan = Kas::where('tipe', 'masuk')->sum('jumlah');
        $pengeluaran = Kas::where('tipe', 'keluar')->sum('jumlah');
        $saldo = $pemasukan - $pengeluaran;
        $selisih =  $existingSaldo - $saldo;
        $data = Kas::all(); // Ambil semua data kas
        return view('admin.keuangan.rgb.kas.index', compact('data', 'pemasukan', 'pengeluaran', 'saldo', 'selisih'));
    }

    public function create()
    {
        //using modal
    }

    public function store(Request $request)
    {
        // Validasi input dari form
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|string',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'tipe' => 'required|in:masuk,keluar',
            'nama_pembayar' => 'nullable|string',
            'metode_pembayaran' => 'nullable|string',
            'referensi' => 'nullable|string',
        ]);

        // Ambil saldo terakhir dari record terakhir di tabel Kas
        $lastRecord = Kas::latest()->first();
        $existingSaldo = $lastRecord ? $lastRecord->saldo : 0; // Jika tidak ada record, saldo awal dianggap 0

        // Hitung saldo baru berdasarkan tipe transaksi
        $newSaldo = $request->tipe === 'masuk' ? $existingSaldo + $request->jumlah : $existingSaldo - $request->jumlah;

        // Simpan data baru ke tabel Kas
        Kas::create([
            'tanggal' => $request->tanggal,
            'jenis' => $request->jenis,
            'jumlah' => $request->jumlah,
            'keterangan' => $request->keterangan,
            'tipe' => $request->tipe,
            'saldo' => $newSaldo, // Gunakan saldo baru
            'nama_pembayar' => $request->nama_pembayar,
            'metode_pembayaran' => $request->metode_pembayaran,
            'referensi' => $request->referensi,
        ]);

        return redirect()->route('kas.index')->with('success', 'Data kas berhasil ditambahkan.');
    }

    public function edit($id)
    {
        $kas = Kas::findOrFail($id);
        return view('admin.keuangan.rgb.kas.edit', compact('kas'));
    }

    public function update(Request $request, $id)
    {
        $request->validate([
            'tanggal' => 'required|date',
            'jenis' => 'required|string',
            'jumlah' => 'required|numeric',
            'keterangan' => 'nullable|string',
            'tipe' => 'required|in:masuk,keluar',
            'saldo' => 'nullable|numeric',
            'nama_pembayar' => 'nullable|string',
            'metode_pembayaran' => 'nullable|string',
            'referensi' => 'nullable|string',
        ]);

        $kas = Kas::findOrFail($id);
        $kas->update($request->all());
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil diperbarui.');
    }

    public function destroy($id)
    {
        $kas = Kas::findOrFail($id);
        $kas->delete();
        return redirect()->route('kas.index')->with('success', 'Data kas berhasil dihapus.');
    }
    public function cetak()
    {
        // Ambil data kas untuk tahun yang sedang berjalan
        $currentYear = Carbon::now()->year;  // Mendapatkan tahun saat ini
        $data = Kas::whereYear('tanggal', $currentYear)->get();  // Filter berdasarkan tahun

        // Inisialisasi TCPDF
        $pdf = new TCPDF('L', 'mm', 'A4'); // Mode landscape
        $pdf->SetHeaderData('', 0, 'Laporan Kas');

        // Set font untuk header dan konten
        $pdf->SetFont('helvetica', '', 12);

        // Tambahkan halaman baru
        $pdf->AddPage();

        // Judul halaman
        $pdf->SetFont('helvetica', 'B', 16);
        $pdf->Cell(0, 10, 'Laporan Kas Tahun ' . $currentYear, 0, 1, 'C');
        $pdf->Ln(10);  // Jarak setelah judul

        // Header tabel
        $pdf->SetFont('helvetica', 'B', 10);
        $pdf->Cell(25, 10, 'Tanggal', 1, 0, 'C', 0);
        $pdf->Cell(25, 10, 'Jenis', 1, 0, 'C', 0);
        $pdf->Cell(30, 10, 'Jumlah', 1, 0, 'C', 0);
        $pdf->Cell(50, 10, 'Keterangan', 1, 0, 'C', 0);
        $pdf->Cell(20, 10, 'Tipe', 1, 0, 'C', 0);
        $pdf->Cell(30, 10, 'Saldo', 1, 0, 'C', 0);
        $pdf->Cell(30, 10, 'Pembayar', 1, 0, 'C', 0);
        $pdf->Cell(30, 10, 'Metode', 1, 0, 'C', 0);
        $pdf->Cell(38, 10, 'Referensi', 1, 1, 'C', 0);

        // Set font untuk data
        $pdf->SetFont('helvetica', '', 10);

        // Fungsi untuk format rupiah
        function formatRupiah($angka)
        {
            return 'Rp. ' . number_format($angka, 0, ',', '.');
        }

        // Menambahkan data ke tabel
        foreach ($data as $kas) {
            $pdf->Cell(25, 10, $kas->tanggal, 1, 0, 'C'); // Format tanggal
            $pdf->Cell(25, 10, $kas->jenis, 1, 0, 'C');
            $pdf->Cell(30, 10, formatRupiah($kas->jumlah), 1, 0, 'C');
            $pdf->Cell(50, 10, $kas->keterangan, 1, 0, 'C');
            $pdf->Cell(20, 10, $kas->tipe, 1, 0, 'C');
            $pdf->Cell(30, 10, formatRupiah($kas->saldo), 1, 0, 'C');
            $pdf->Cell(30, 10, $kas->nama_pembayar, 1, 0, 'C');
            $pdf->Cell(30, 10, $kas->metode_pembayaran, 1, 0, 'C');
            $pdf->Cell(38, 10, $kas->referensi, 1, 1, 'C');
        }

        // Output file PDF
        $pdf->Output('Laporan_Kas_Tahun_' . $currentYear . '.pdf', 'I');
    }
}
