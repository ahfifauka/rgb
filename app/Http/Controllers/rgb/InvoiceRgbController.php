<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use TCPDF;


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
            'no_faktur' => 'required|numeric',
            'customer' => 'required|string',
            'banyak' => 'required|numeric',
            'harga' => 'required|numeric',
            'rekening' => 'required|string',
            'periode' => 'required|string',
            'due_date' => 'required|string',
            'penggantian' => 'required|numeric',
        ]);

        // Ambil alamat dari model Area berdasarkan customer
        $area = Area::where('area', $request->customer)->first();
        $alamat = $area ? $area->alamat : null;

        // Hitung PPN (11%) dan PPh (2%)
        $harga = $request->input('harga');
        $banyak = $request->input('banyak');

        $ppn = $harga * $banyak * 0.11; // PPN 11%
        $pph = $harga * $banyak * 0.02; // PPh 2%

        // Buat data untuk disimpan
        $data = $request->all();
        $data['alamat'] = $alamat;
        $data['ppn'] = $ppn;
        $data['pph'] = $pph;

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
            'no_faktur' => 'required|numeric',
            'customer' => 'required|string',
            'banyak' => 'required|numeric',
            'harga' => 'required|numeric',
            'rekening' => 'required|string',
            'periode' => 'required|string',
            'due_date' => 'required|date',
            'penggantian' => 'required|numeric',
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
}
