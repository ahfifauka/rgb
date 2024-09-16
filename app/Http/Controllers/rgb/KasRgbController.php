<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Kas;
use Illuminate\Http\Request;

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
}
