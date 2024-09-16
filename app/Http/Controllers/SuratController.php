<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Surat;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use TCPDF;


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
}
