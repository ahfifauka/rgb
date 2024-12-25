<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use TCPDF;
use App\Models\SuratP;

class SuratController extends Controller
{

    public function generateNoSurat($status)
    {
        $now = Carbon::now();
        $bulan = $now->format('m'); // Bulan dalam format numerik
        $tahun = $now->format('Y'); // Tahun

        // Ambil nomor terakhir berdasarkan bulan, tahun, dan status saat ini
        $lastNoSurat = Surat::whereYear('created_at', $tahun)
            ->whereMonth('created_at', $bulan)
            ->where('status', $status) // Tambahkan filter status
            ->orderBy('created_at', 'desc')
            ->value('no_surat');

        // Jika ada nomor surat sebelumnya
        if ($lastNoSurat) {
            // Ambil nomor urut dari nomor surat yang terakhir
            $lastNumber = (int) substr($lastNoSurat, 4, 5); // Ambil bagian nomor dari 'No. 00030'
            $newNumber = $lastNumber + 1;
        } else {
            $newNumber = 1; // Mulai dari 00001 jika tidak ada data
        }

        // Format nomor surat baru
        $nomor = str_pad($newNumber, 5, '0', STR_PAD_LEFT); // Misalnya 00001
        $bulanRomawi = [
            '01' => 'I',
            '02' => 'II',
            '03' => 'III',
            '04' => 'IV',
            '05' => 'V',
            '06' => 'VI',
            '07' => 'VII',
            '08' => 'VIII',
            '09' => 'IX',
            '10' => 'X',
            '11' => 'XI',
            '12' => 'XII',
        ][$bulan] ?? 'I'; // Default ke I jika tidak ditemukan
        $noSurat = "No. {$nomor}/SPT/HRD/RGB-86SS/{$bulanRomawi}/{$tahun}";

        return response()->json([
            'no_surat' => $noSurat
        ]);
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Surat::create($data);
        return redirect()->route('AkunRgb.index')->with('success', 'Data berhasil disimpan.');
    }

    public function real($nik)
    {
        $data = Surat::where('nik', $nik)
            ->where('status', 'Real')
            ->firstOrFail();

        // Konfigurasi TCPDF
        $pdf = new TCPDF();

        // Set metadata
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('HRD RGB');
        $pdf->SetTitle('Surat Tugas Real');
        $pdf->SetSubject('Surat Tugas untuk ' . $data->name);

        // Set header dan footer
        $pdf->setHeaderData('', 0, 'Surat Tugas Real', 'HRD RGB');
        $pdf->setFooterData();

        // Set margins
        $pdf->SetMargins(15, 30, 15);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(true);

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add a page
        $pdf->AddPage();

        // Load view untuk surat dan ambil outputnya sebagai string
        $view = view('admin.hrd.rgb.akun.cetak.surat', compact('data'))->render();

        // Write HTML content to PDF
        $pdf->writeHTML($view, true, false, true, false, '');

        // Output PDF ke browser
        return $pdf->output('Surat_Tugas_Real' . $data->no_surat . '.pdf', 'I');
    }

    public function sementara($nik)
    {
        $data = Surat::where('nik', $nik)
            ->where('status', 'Sementara')
            ->firstOrFail();

        // Konfigurasi TCPDF
        $pdf = new TCPDF();

        // Set metadata
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('HRD RGB');
        $pdf->SetTitle('Surat Tugas Sementara');
        $pdf->SetSubject('Surat Tugas Sementara untuk ' . $data->name);

        // Set header dan footer
        $pdf->setHeaderData('', 0, 'Surat Tugas Sementara', 'HRD RGB');
        $pdf->setFooterData();

        // Set margins
        $pdf->SetMargins(15, 30, 15);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(true);

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add a page
        $pdf->AddPage();

        // Load view untuk surat dan ambil outputnya sebagai string
        $view = view('admin.hrd.rgb.akun.cetak.surat', compact('data'))->render();

        // Write HTML content to PDF
        $pdf->writeHTML($view, true, false, true, false, '');

        // Output PDF ke browser
        return $pdf->output('Surat_Tugas_Sementara_' . $data->no_surat . '.pdf', 'I');
    }

    public function peringatan($id)
    {
        $users = User::findOrFail($id);
        return view('admin.hrd.rgb.akun.peringatan', compact('users'));
    }
    public function peringatanp(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|string',
            'jenis' => 'required|integer',
            'keterangan' => 'nullable|string', // Keterangan tidak wajib diisi
        ]);

        // Menyimpan data ke dalam database menggunakan request()->all()
        // Sesuaikan dengan nama kolom pada tabel Surat Anda
        $validatedData['status'] = 'peringatan';
        $surat = SuratP::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('AkunRgb.index')->with('success', 'Surat berhasil dibuat.');
    }

    public function peringatanc($nik)
    {
        $data = SuratP::where('nik', $nik)
            ->where('status', 'peringatan')
            ->firstOrFail();

        // Konfigurasi TCPDF
        $pdf = new TCPDF();

        // Set metadata
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('HRD RGB');
        $pdf->SetTitle('Surat Peringatan');
        $pdf->SetSubject('Surat Peringatan untuk ' . $data->name);

        // Set header dan footer
        $pdf->setHeaderData('', 0, 'Surat Peringatan', 'HRD RGB');
        $pdf->setFooterData();

        // Set margins
        $pdf->SetMargins(15, 30, 15);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(true);

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add a page
        $pdf->AddPage();

        // Load view untuk surat dan ambil outputnya sebagai string
        $view = view('admin.hrd.rgb.akun.cetak.peringatan', compact('data'))->render();

        // Write HTML content to PDF
        $pdf->writeHTML($view, true, false, true, false, '');

        // Output PDF ke browser
        return $pdf->output('Surat_Peringatan_' . $data->nik . '.pdf', 'I');
    }

    public function teguran($id)
    {
        $users = User::findOrFail($id);
        return view('admin.hrd.rgb.akun.teguran', compact('users'));
    }
    public function teguranp(Request $request)
    {
        // Validasi input
        $validatedData = $request->validate([
            'name' => 'required|string',
            'nik' => 'required|string',
            'jenis' => 'required|integer',
            'keterangan' => 'nullable|string', // Keterangan tidak wajib diisi
        ]);

        // Menyimpan data ke dalam database menggunakan request()->all()
        // Sesuaikan dengan nama kolom pada tabel Surat Anda
        $validatedData['status'] = 'teguran';
        $surat = SuratP::create($validatedData);

        // Redirect dengan pesan sukses
        return redirect()->route('AkunRgb.index')->with('success', 'Surat berhasil dibuat.');
    }

    public function teguranc($nik)
    {
        $data = SuratP::where('nik', $nik)
            ->where('status', 'teguran')
            ->firstOrFail();

        // Konfigurasi TCPDF
        $pdf = new TCPDF();

        // Set metadata
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('HRD RGB');
        $pdf->SetTitle('Surat teguran');
        $pdf->SetSubject('Surat teguran untuk ' . $data->name);

        // Set header dan footer
        $pdf->setHeaderData('', 0, 'Surat teguran', 'HRD RGB');
        $pdf->setFooterData();

        // Set margins
        $pdf->SetMargins(15, 30, 15);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(10);

        // Set auto page breaks
        $pdf->SetAutoPageBreak(true);

        // Set font
        $pdf->SetFont('helvetica', '', 12);

        // Add a page
        $pdf->AddPage();

        // Load view untuk surat dan ambil outputnya sebagai string
        $view = view('admin.hrd.rgb.akun.cetak.teguran', compact('data'))->render();

        // Write HTML content to PDF
        $pdf->writeHTML($view, true, false, true, false, '');

        // Output PDF ke browser
        return $pdf->output('Surat_Teguran_' . $data->nik . '.pdf', 'I');
    }

    public function pkwt($id)
    {
        $now = Carbon::now();
        $bulan = $now->format('m'); // Bulan dalam format numerik
        $tahun = $now->format('Y'); // Tahun

        // Awalan nomor surat
        $nomorAwal = "PKWT/HRD/RGB-86SS/W/" . $tahun;

        // Cari nomor surat dengan awalan yang sama, urutkan berdasarkan nomor terbesar, ambil yang pertama
        $surat = Surat::where('no_surat', 'like', $nomorAwal . '%')
            ->orderByDesc('no_surat') // Urutkan dari nomor terbesar
            ->first();

        if ($surat) {
            // Ambil nomor terakhir dari surat yang ditemukan
            $lastNumber = (int) filter_var($surat->no_surat, FILTER_SANITIZE_NUMBER_INT);
            // Tambahkan 1 dan buat menjadi 3 digit
            $nextNumber = str_pad($lastNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // Jika belum ada, mulai dari 1 dengan format 3 digit
            $nextNumber = '001';
        }

        // Gabungkan dengan awalan dan nomor urut yang baru
        $nomorPkwt = $nextNumber . '/' . $nomorAwal . '/';

        $user = User::findOrFail($id);

        return view('admin.hrd.rgb.akun.pkwt', compact('nomorPkwt', 'user'));
    }

    public function pkwtp(Request $request)
    {
        $validatedData = $request->validate([
            'no_surat' => 'required|string',
            'name' => 'required|string',
            'nik' => 'required|string',
            'level' => 'required|string',
            'status' => 'required|string',
            'area' => 'required|string',
        ]);

        $surat = Surat::create($validatedData);

        return redirect()->route('AkunRgb.index')->with('success', 'Surat berhasil dibuat.');
    }

        public function pkwtc($nik)
        {
            $data = Surat::where('nik', $nik)
                ->where('status', 'PKWT')
                ->firstOrFail();

            $pdf = new TCPDF();

            // Set metadata
            $pdf->SetCreator(PDF_CREATOR);
            $pdf->SetAuthor('HRD RGB');
            $pdf->SetTitle('Surat PKWT');
            $pdf->SetSubject('Surat PKWT untuk ' . $data->name);

            // Set header dan footer
            $pdf->setHeaderData('', 0, 'Surat PKWT', 'HRD RGB');
            $pdf->setFooterData();

            // Set margins
            $pdf->SetMargins(15, 30, 15);
            $pdf->SetHeaderMargin(10);
            $pdf->SetFooterMargin(10);

            // Set auto page breaks
            $pdf->SetAutoPageBreak(true);

            // Set font
            $pdf->SetFont('helvetica', '', 12);

            // Add a page
            $pdf->AddPage();

            // Load view untuk surat dan ambil outputnya sebagai string
            $view = view('admin.hrd.rgb.akun.cetak.pkwt', compact('data'))->render();

            // Write HTML content to PDF
            $pdf->writeHTML($view, true, false, true, false, '');

            // Output PDF ke browser
            return $pdf->output('PKWT_' . $data->nik . '.pdf', 'I');
        }
}
