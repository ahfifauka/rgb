<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;
use Carbon\Carbon; // Make sure to import Carbon
use TCPDF;

class JadwalRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $currentMonth = Carbon::now()->month; // Mendapatkan bulan saat ini
        $currentYear = Carbon::now()->year;   // Mendapatkan tahun saat ini
        $area = Area::all()->pluck('area');

        $data = Jadwal::whereMonth('created_at', $currentMonth) // Filter berdasarkan bulan
            ->whereYear('created_at', $currentYear)             // Filter berdasarkan tahun
            ->orderBy('area')                                   // Urutkan berdasarkan 'area'
            ->orderBy('name')                                   // Urutkan berdasarkan 'name' jika 'area' sama
            ->get();


        return view('admin.oprational.rgb.jadwal.index', compact('data', 'area'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Area::all();
        return view('admin.oprational.rgb.jadwal.create', compact('data'));
    }

    public function getUsersByArea(Request $request)
    {
        $area = $request->query('area');

        if (!$area) {
            return response()->json(['error' => 'Area is required'], 400);
        }

        // Lakukan query untuk mencari user berdasarkan area
        $users = User::where('area', $area)->get();

        if ($users->isEmpty()) {
            return response()->json(['error' => 'No users found'], 404);
        }

        return response()->json($users);
    }



    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        //
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
        $data = Jadwal::findOrFail($id);
        return view('admin.oprational.rgb.jadwal.edit', compact('data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Jadwal::findOrFail($id);

        // Mengupdate jadwal untuk setiap hari
        for ($day = 1; $day <= 31; $day++) {
            $data->{$day} = $request->input('day_' . $day);
        }

        $data->save();

        return redirect()->route('jadwal.index')->with('success', 'Jadwal berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        //
    }

    public function uploadTemplate(Request $request)
    {
        $request->validate([
            'file' => 'required|mimes:xlsx',
        ]);

        // Proses file Excel yang di-upload
        $file = $request->file('file');
        $spreadsheet = Excel::toArray([], $file);

        foreach ($spreadsheet[0] as $key => $row) {
            if ($key === 0) {
                // Lewati baris header
                continue;
            }

            // Simpan atau update jadwal di database
            Jadwal::create([
                'nik' => $row[2],
                'name' => $row[1],
                'area' => $row[3],
                '1' => $row[4] ?? null,
                '2' => $row[5] ?? null,
                '3' => $row[6] ?? null,
                '4' => $row[7] ?? null,
                '5' => $row[8] ?? null,
                '6' => $row[9] ?? null,
                '7' => $row[10] ?? null,
                '8' => $row[11] ?? null,
                '9' => $row[12] ?? null,
                '10' => $row[13] ?? null,
                '11' => $row[14] ?? null,
                '12' => $row[15] ?? null,
                '13' => $row[16] ?? null,
                '14' => $row[17] ?? null,
                '15' => $row[18] ?? null,
                '16' => $row[19] ?? null,
                '17' => $row[20] ?? null,
                '18' => $row[21] ?? null,
                '19' => $row[22] ?? null,
                '20' => $row[23] ?? null,
                '21' => $row[24] ?? null,
                '22' => $row[25] ?? null,
                '23' => $row[26] ?? null,
                '24' => $row[27] ?? null,
                '25' => $row[28] ?? null,
                '26' => $row[29] ?? null,
                '27' => $row[30] ?? null,
                '28' => $row[31] ?? null,
                '29' => $row[32] ?? null,
                '30' => $row[33] ?? null,
                '31' => $row[34] ?? null,
            ]);
        }

        return redirect()->back()->with('success', 'Template successfully uploaded and processed.');
    }

    public function generateLaporanJadwal(Request $request)
    {
        $currentMonth = Carbon::now()->month; // Bulan saat ini
        $currentYear = Carbon::now()->year;   // Tahun saat ini

        // Ambil jumlah hari dalam bulan yang sedang berjalan
        $daysInMonth = Carbon::now()->daysInMonth;

        // Ambil data area berdasarkan input request
        $area = Jadwal::whereMonth('created_at', $currentMonth) // Filter berdasarkan bulan
            ->whereYear('created_at', $currentYear)           // Filter berdasarkan tahun
            ->where('area', $request->area)
            ->orderBy('area')                                   // Urutkan berdasarkan 'area'
            ->orderBy('name')                                   // Urutkan berdasarkan 'name' jika 'area' sama
            ->get();

        // Inisialisasi TCPDF
        $pdf = new TCPDF('L', PDF_UNIT, PDF_PAGE_FORMAT, true, 'UTF-8', false); // Landscape
        $pdf->SetCreator(PDF_CREATOR);
        $pdf->SetAuthor('Your App Name');
        $pdf->SetTitle('Laporan Jadwal');
        $pdf->SetSubject('Laporan Jadwal Area');
        $pdf->SetKeywords('TCPDF, PDF, laporan, jadwal');

        // Set margin lebih kecil dan header/footer tidak dicetak
        $pdf->SetMargins(10, 10, 10); // Atur margin kecil
        $pdf->setPrintHeader(false);
        $pdf->setPrintFooter(false);

        // Tambahkan halaman baru
        $pdf->AddPage();

        // Judul dokumen
        $html = '
    <h1 style="text-align: center; font-size: 14px;">Laporan Jadwal Area</h1>
    <p style="text-align: center; font-size: 12px;">Area: ' . htmlspecialchars($request->area) . '</p>
    <table border="1" cellpadding="4" style="width: 100%; border-collapse: collapse; font-size: 10px; white-space: nowrap;">
        <thead>
            <tr style="background-color: #f2f2f2;">
                <th style="text-align: center; white-space: nowrap; font-size: 8px;">No</th>
                <th style="text-align: center; white-space: nowrap; font-size: 8px; width: 140px;">Nama</th>
                <th style="text-align: center; white-space: nowrap; font-size: 8px; width: 100px;">NIK</th>';

        // Tambahkan kolom sesuai jumlah hari dalam bulan
        for ($i = 1; $i <= $daysInMonth; $i++) {
            $html .= '<th style="text-align: center; font-size: 8px; width: 17px;">' . $i . '</th>';
        }

        $html .= '
            </tr>
        </thead>
        <tbody>';

        // Loop data area untuk menambahkan ke tabel
        foreach ($area as $key => $data) {
            $html .= '
        <tr>
            <td style="text-align: center; font-size: 8px;">' . ($key + 1) . '</td>
            <td style="text-align: left; font-size: 8px; width: 140px;">' . htmlspecialchars($data->name) . '</td>
            <td style="text-align: center; font-size: 8px; width: 100px;">' . htmlspecialchars($data->nik) . '</td>';

            // Isi kolom tanggal sesuai jumlah hari dalam bulan
            for ($i = 1; $i <= $daysInMonth; $i++) {
                $fieldName = $i; // Misal: 'day_1', 'day_2', dst.
                $html .= '<td style="text-align: center; font-size: 8px; width: 17px;">' . $data->$fieldName . '</td>';
            }

            $html .= '
        </tr>';
        }

        $html .= '
        </tbody>
    </table>';

        // Tulis HTML ke PDF
        $pdf->writeHTML($html, true, false, true, false, '');

        // Output PDF
        $pdf->Output('Laporan_Jadwal.pdf', 'I'); // 'I' untuk menampilkan di browser, gunakan 'D' untuk mendownload langsung
    }
}
