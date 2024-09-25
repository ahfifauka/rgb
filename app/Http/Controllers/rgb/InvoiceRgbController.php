<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Invoice;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


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
