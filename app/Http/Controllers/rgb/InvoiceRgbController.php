<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCPDF;
use Carbon\Carbon;


class InvoiceRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentMonth = date('m');
        $currentYear = date('Y');

        // Convert month to Roman numeral
        $romanMonths = [
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
        ];
        $romanMonth = $romanMonths[$currentMonth];

        // Get the last invoice number from the database for the current year
        $lastInvoice = DB::table('invoices')
            ->whereYear('created_at', $currentYear)
            ->whereMonth('created_at', $currentMonth)
            ->orderBy('no_invoice', 'desc')
            ->first();

        // Determine the next invoice number
        if ($lastInvoice) {
            // Extract the numeric part and increment it
            $lastInvoiceNumber = intval(substr($lastInvoice->no_invoice, 0, 3));
            $nextInvoiceNumber = str_pad($lastInvoiceNumber + 1, 3, '0', STR_PAD_LEFT);
        } else {
            // Start from 001 if there is no invoice for the current month and year
            $nextInvoiceNumber = '001';
        }

        // Generate the complete invoice number
        $invoiceNumber = $nextInvoiceNumber . "/RGB-86SS/Inv/" . $romanMonth . "/" . $currentYear;

        $lokasi = Area::all();
        $data = Invoice::all();
        return view('admin.keuangan.rgb.invoice.index', compact('data', 'lokasi', 'invoiceNumber'));
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
        $request->validate([
            'no_invoice' => 'required|string|max:255',
            'no_faktur' => 'required|string',
            'customer' => 'required|string',
            'banyak' => 'required|numeric',
            'harga' => 'required|numeric',
            'rekening' => 'required|string',
            'periode' => 'required|string',
            'due_date' => 'required|string',
            'penggantian' => 'required|numeric',
            'fee' => 'required|numeric',
            'tanggal_lemburan' => 'nullable|string',
            'personil_lemburan' => 'nullable|string',
            'biaya_lemburan' => 'nullable|string',
        ]);

        // Ambil alamat dari model Area berdasarkan customer
        $area = Area::where('area', $request->customer)->first();
        $alamat = $area ? $area->alamat : null;

        // Buat data untuk disimpan
        $data = $request->all();
        $data['alamat'] = $alamat;

        // Menyimpan semua data ke dalam model Area
        Invoice::create($data);

        // Redirect atau response setelah berhasil menyimpan
        return redirect()->route('invoice.index')->with('success', 'Data berhasil disimpan');
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
        $data = Invoice::findOrFail($id);
        $lokasi = Area::all();
        return view('admin.keuangan.rgb.invoice.edit', compact('data', 'lokasi'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        // Validasi input
        $request->validate([
            'no_invoice' => 'required|string',
            'no_faktur' => 'required|string',
            'customer' => 'required|string',
            'banyak' => 'required|numeric',
            'harga' => 'required|numeric',
            'rekening' => 'required|string',
            'periode' => 'required|string',
            'due_date' => 'required|date',
            'penggantian' => 'required|numeric',
            'fee' => 'required|numeric',
            'tanggal_lemburan' => 'nullable|string',
            'personil_lemburan' => 'nullable|string',
            'biaya_lemburan' => 'nullable|string',
        ]);

        try {
            // Cari data berdasarkan ID
            $invoice = Invoice::findOrFail($id);

            // Update data
            $invoice->update([
                'no_invoice' => $request->no_invoice,
                'no_faktur' => $request->no_faktur,
                'customer' => $request->customer,
                'banyak' => $request->banyak,
                'harga' => $request->harga,
                'rekening' => $request->rekening,
                'periode' => $request->periode,
                'due_date' => $request->due_date,
                'penggantian' => $request->penggantian,
                'tanggal_lemburan' => $request->tanggal_lemburan,
                'personil_lemburan' => $request->personil_lemburan,
                'biaya_lemburan' => $request->biaya_lemburan,
            ]);

            // Redirect ke halaman tertentu dengan pesan sukses
            return redirect()->route('invoice.index')->with('success', 'Invoice berhasil diperbarui.');
        } catch (\Exception $e) {
            // Jika terjadi kesalahan
            return redirect()->back()->with('error', 'Terjadi kesalahan saat memperbarui invoice.');
        }
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Invoice::findOrFail($id);
        $data->delete();
        return redirect()->route('invoice.index')->with('success', 'Data berhasil dihapus');
    }

    public function cetak()
    {
        // Ambil data dari model
        $data = Invoice::all();

        // Buat instance TCPDF
        $pdf = new TCPDF('L', 'mm', 'A4', true, 'UTF-8', false);
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your Application');
        $pdf->SetTitle('Laporan Invoice');
        $pdf->SetSubject('Laporan Invoice');

        // Set margin dan header
        $pdf->SetMargins(10, 20, 10);
        $pdf->SetHeaderMargin(10);
        $pdf->SetFooterMargin(15);

        // Header
        $pdf->setPrintHeader(true);
        $pdf->setPrintFooter(true);
        $pdf->SetHeaderData('', 0, 'Laporan Invoice', 'Periode: ' . now()->format('Y'));

        // Tambahkan halaman
        $pdf->AddPage();
        // Set font
        $pdf->SetFont('helvetica', '', 7);
        $pdf->Ln(10);

        // Header Tabel
        $tblHeader = <<<EOD
<table cellspacing="0" cellpadding="5" border="1">
    <thead>
        <tr style="background-color: #f2f2f2; text-align: center;">
            <th>No</th>
            <th>No Invoice</th>
            <th>No Faktur</th>
            <th>Customer</th>
            <th>Alamat</th>
            <th>Banyak</th>
            <th>Harga</th>
            <th>Rekening</th>
            <th>Periode</th>
            <th>Due Date</th>
            <th>Penggantian</th>
            <th>PPH</th>
            <th>PPN</th>
        </tr>
    </thead>
    <tbody>
EOD;

        // Isi Tabel
        $tblContent = '';
        $no = 1;
        foreach ($data as $row) {
            $tblContent .= '<tr>';
            $tblContent .= '<td style="text-align: center;">' . $no++ . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->no_invoice . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->no_faktur . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->customer . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->alamat . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->banyak . '</td>';
            $tblContent .= '<td style="text-align: center;">' . number_format($row->harga, 2, ',', '.') . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->rekening . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->periode . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->due_date . '</td>';
            $tblContent .= '<td style="text-align: center;">' . number_format($row->penggantian, 2, ',', '.') . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->pph . '</td>';
            $tblContent .= '<td style="text-align: center;">' . $row->ppn . '</td>';
            $tblContent .= '</tr>';
        }

        // Penutup Tabel
        $tblFooter = <<<EOD
    </tbody>
</table>
EOD;

        // Gabungkan tabel
        $tbl = $tblHeader . $tblContent . $tblFooter;

        // Tulis tabel ke PDF
        $pdf->writeHTML($tbl, true, false, false, false, '');

        // Footer
        $pdf->SetY(-15);
        $pdf->SetFont('helvetica', 'I', 8);
        $pdf->Cell(0, 10, 'Halaman ' . $pdf->getAliasNumPage() . ' dari ' . $pdf->getAliasNbPages(), 0, 0, 'C');

        // Output PDF
        $pdf->Output('Laporan_Invoice.pdf', 'I');
    }

    public function laporan($id)
    {
        $data = Invoice::findOrFail($id);
        $date = Carbon::parse($data->created_at)->translatedFormat('d F Y');
        $duedate = Carbon::parse($data->due_date)->translatedFormat('d F Y');
        $tanggal_lemburan = Carbon::parse($data->tanggal_lemburan)->translatedFormat('d F');

        $rekening = $data->rekening;
        // Memecah string berdasarkan delimiter "|"
        $parts = explode(" | ", $rekening);
        // Ambil nomor rekening yang ada di tengah
        $nomorRekening = $parts[1];

        $bank = $data->rekening;
        // Memecah string berdasarkan delimiter "|"
        $parts2 = explode(" | ", $bank);
        // Ambil nomor rekening yang ada di tengah
        $namabank = $parts2[2];

        $harga = $data->harga; // Misal harga = 1234567
        $hargaFormatted = 'Rp ' . number_format($harga, 0, ',', '.');
        $totalHarga = $data->harga * $data->banyak;
        $totalHargaFormated = 'Rp ' . number_format($totalHarga, 0, ',', '.');

        $fee = $data->fee;
        $feeFormatted = 'Rp ' . number_format($fee, 0, ',', '.');
        $totalfee = $data->fee * $data->banyak;
        $totalfeeFormated = 'Rp ' . number_format($totalfee, 0, ',', '.');

        $lemburan = $data->biaya_lemburan;
        $lemburanFormated = 'Rp ' . number_format($lemburan, 0, ',', '.');
        $lemburantotal = $data->biaya_lemburan * $data->personil_lemburan;
        $lemburantotalFormated = 'Rp ' . number_format($lemburantotal, 0, ',', '.');

        $ppn = $totalfee * 0.11;
        $pph = $totalfee * 0.2;
        $ppnFormatted = 'Rp ' . number_format($ppn, 0, ',', '.');
        $pphFormatted = 'Rp ' . number_format($pph, 0, ',', '.');

        $total = $totalHarga + $totalfee + $lemburantotal - $ppn - $pph;
        $totalFormatted = 'Rp ' . number_format($total, 0, ',', '.');

        [$start, $end] = explode(' to ', $data->periode);

        // Parse tanggal menggunakan Carbon
        $startDate = Carbon::parse($start);
        $endDate = Carbon::parse($end);

        // Format menjadi "24 s.d 31 Desember 2024"
        $formattedPeriode = $startDate->format('d') . ' s.d ' . $endDate->translatedFormat('d F Y');
        // Inisialisasi TCPDF
        $pdf = new TCPDF('P', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false);

        // Konfigurasi dokumen
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('PT Rajawali Buana');
        $pdf->SetTitle('Laporan');
        $pdf->SetSubject('Laporan PDF');
        $pdf->SetKeywords('TCPDF, PDF, laporan');

        // Set margin lebih kecil dan header/footer tidak dicetak
        $pdf->SetMargins(10, 10, 10);
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Tambahkan halaman baru
        $pdf->AddPage();

        // Tambahkan gambar logo
        $logoPath = public_path('images/logo/logorgb.png'); // Sesuaikan path logo Anda
        if (file_exists($logoPath)) {
            $pdf->Image($logoPath, 20, 20, 26); // Atur posisi dan ukuran logo (x, y, lebar)
            $pdf->SetAlpha(0.1); // Set opacity 10% untuk background
            $pdf->Image($logoPath, 40, 90, 130, 0, 'PNG'); // Menyesuaikan posisi dan ukuran
            $pdf->SetAlpha(1); // Kembalikan opacity ke normal untuk teks berikutnya
        }

        // Tambahkan teks header
        $html = '
    <div style="text-align: center; margin-left: 20px;">
        <h1 style="color: yellow; font-size: 20px;margin-left: 20px;"><span style="color: white;"> _____</span>PT Rajawali Buana - 86</h1>
        <h2 style="color: red; font-size: 18px;margin-left: 20px;"><span style="color: white"> _____</span>Security System</h2>
    </div>
    <div style="display:flex; justify-content:center; width:100%">
    <table style="font-size:8.5px">
    
    <tr>
    <td style="text-align:right; width:150px"><b>NO. NPWP</b></td>
    <td style="width:10px"></td>
    <td style="width:205px">70.541.765.7-017.000</td>
    <td style="width:10px"></td>
    <td style="width:145px"><b>No. Invoice</b><br>' . $data->no_invoice . '</td>
    </tr>

    <tr>
    <td></td>
    </tr>

    <tr>
    <td style="text-align:right"><b>CUSTOMER NAME</b><br><span style="font-size:8px">NAMA PELANGGAN</span></td>
    <td></td>
    <td>' . $data->customer . '</td>
    <td></td>
    <td><b>No. Faktur Pajak</b><br>' . $data->no_faktur . '</td>
    </tr>

    <tr>
    <td></td>
    </tr>

    <tr>
    <td style="text-align:right; border-bottom:1px solid black;"><b>ADDRESS</b><br><span style="font-size:8px">ALAMAT</span><br></td>
    <td></td>
    <td style="border-bottom: 1px solid black">' . $data->alamat . '</td>
    <td></td>
    <td style="border-bottom: 1px solid black;"></td>
    </tr>

    <tr>
    <td></td>
    </tr>

    <tr>
    <td style="text-align:right; border-bottom:1px solid black;"><b>DATE</b><br><span style="font-size:8px">TANGGAL</span><br></td>
    <td></td>
    <td style="border-bottom: 1px solid black">' . $date . '</td>
    <td></td>
    <td style="border-bottom: 1px solid black;"></td>
    </tr>

    <tr>
    <td></td>
    </tr>

    <tr>
    <td style="text-align:right;"><b>DESCRIPTION</b><br><span style="font-size:8px">KETERANGAN</span><br></td>
    <td></td>
    <td colspan="3">
        <table>
            <tr>
            <td style="width:190px">Penggantian Biaya Gaji dan Oprational ' . $data->banyak . ' personil Anggota Security Service @ ' . $hargaFormatted . '</td>
            <td style="width:30px"></td>
            <td style="width:130px; text-align:right">' . $totalHargaFormated . '</td>
            </tr>
            <tr>
            <td>Management fee ' . $data->banyak . ' Personil Anggota Security Service @ ' . $feeFormatted . '</td>
            <td></td>
            <td style="text-align:right">' . $totalfeeFormated . '</td>
            </tr>';

        if (!empty($data->personil_lemburan)) {
            $html .= '
                    <tr>
            <td>Penggantian Biaya Lembur Tanggal ' . $tanggal_lemburan . ', ' . $data->personil_lemburan . ' orang @ ' . $lemburanFormated . '</td>
            <td></td>
            <td style="text-align:right">' . $lemburantotalFormated . '</td>
            </tr>';
        }

        $html .= '
            
            <tr>
            <td>PPN 11%</td>
            <td></td>
            <td style="text-align:right">' . $ppnFormatted . '</td>
            </tr>
        </table>
    </td>
    <td></td>
    </tr>

    <tr>
    <td style="text-align:right; border-bottom:1px solid black;"></td>
    <td></td>
    <td style="border-bottom: 1px solid black"><span style="color:white">_</span>PPh 23<br></td>
    <td></td>
    <td style="text-align:right; border-bottom: 1px solid black; width:149px">' . $pphFormatted . '</td>
    </tr>
    <tr>
    <td ></td>
    <td></td>
    <td style="text-align:right"><b>TOTAL</b></td>
    <td></td>
    <td style="text-align:right"><b>' . $totalFormatted . '</b></td>
    </tr>

    <tr>
    <td></td>
    </tr>

    <tr>
    <td style="text-align:right"><b>PERIOD</b><br><span style="font-size:8px">PERIODE</span></td>
    <td></td>
    <td>' . $formattedPeriode . '</td>
    <td></td>
    <td style="width:145px"></td>
    </tr>

    <tr>
    <td></td>
    </tr>

    <tr>
    <td style="text-align:right; border-bottom:1px solid black;"><b>DUE DATE</b><br><span style="font-size:8px">JATUH TEMPO</span><br></td>
    <td></td>
    <td style="border-bottom: 1px solid black">' . $duedate . '</td>
    <td></td>
    <td style="border-bottom: 1px solid black;"></td>
    </tr>

    <tr>
    <td></td>
    </tr>

    <tr>
    <td></td>
    <td></td>
    <td></td>
    <td></td>
    <td><b>PAYABLE TO</b><br><span style="font-size:8px">PEMBAYARAN DITUNJUKAN KEPADA</span></td>
    </tr>

    <tr>
    <td></td>
    </tr>

    <tr>
    <td style="text-align:right; border-bottom:1px solid black;"><b>PAYMENT BY</b><br><span style="font-size:8px">PEMBAYARAN DENGAN</span><br></td>
    <td></td>

    <td style="border-bottom: 1px solid black">
    <table>
    <tr>
    <td style="width:15px"><img src="images/logo/empty-checkbox.png" width="10" height="10"/></td>
    <td><b>CASH</b><br><span style="font-size:8px">TUNAI</span><br></td>
    </tr>
    <tr>
    <td><img src="images/logo/empty-checkbox.png" width="10" height="10" /></td>
     <td><b>CEQUE</b><br><span style="font-size:8px">CEK</span><br></td>
    </tr>
    <tr>
    <td><img src="images/logo/empty-checkbox.png" width="10" height="10" /></td>
     <td><b>TRANSFER</b><br><span style="font-size:8px">TRANSFER</span><br></td>
    </tr>
    </table>
    </td>

    <td></td>
    <td style="border-bottom: 1px solid black;"><b>PT. RAJAWALI BUANA 86 A/C ' . $nomorRekening . '</b><br><span style="font-size:8px">' . $namabank . ' CABANG BANDUNG BINACITRA</span></td>
    </tr>

    <tr>
    <td></td>
    </tr>
    <tr>
    <td></td>
    </tr>
    <tr>
    <td></td>
    </tr>

    <tr>
    <td style="text-align:right"><b>AUTORIZED</b><br><span style="font-size:8px">SIGNATURE</span><br></td>
    <td></td>
    <td>STAFF KEUANGAN</td>
    <td></td>
    <td></td>
    </tr>

    <tr>
    <td></td>
    </tr>

    <tr>
    <td colspan="5" style="border-bottom:1px solid black"><div style="background-color:grey; text-align:center; border: 1px solid black">CATATAN: PEMBAYARAN TRANSFER AGAR MENCANTUMKAN INVOICE</div></td>
    </tr>
    <tr>
    <td colspan="5"><br><div style="text-align:center;">Komplek Permata Kopo Blok B No. 76 Telp : 022-54413177 Bandung 40228</div></td>
    </tr>

    <tr>
    <td colspan="2" style="width:240px; text-align:right">Website : www.rgb-86ss.com</td>
    <td style="width:30px"></td>
    <td colspan="2" style="width:240px"><br>Email : info.rgb86ss@gmail.com</td>
    </tr>

    </table>
    </div>';

        // Tulis HTML ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdf->Output('Laporan.pdf', 'I'); // 'I' untuk menampilkan di browser, gunakan 'D' untuk mengunduh langsung
    }
}
