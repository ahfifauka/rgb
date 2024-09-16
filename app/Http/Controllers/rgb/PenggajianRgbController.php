<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Penggajian;
use App\Models\Presensi;
use App\Models\Umr;
use App\Models\User;
use Illuminate\Http\Request;

class PenggajianRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Penggajian::all();
        return view('admin.keuangan.rgb.penggajian.index', compact('data'));
    }

    public function ppn()
    {
        $area = Area::where('pajak', 'PPN')->get();
        return view('admin.keuangan.rgb.penggajian.ppn', compact('area'));
    }

    public function getUsersByArea(Request $request)
    {
        try {
            $selectedArea = $request->input('area');

            if (empty($selectedArea)) {
                return response()->json(['error' => 'Area tidak boleh kosong'], 400);
            }

            // Ambil data gaji pokok dan tunjangan dari model Area berdasarkan area yang dipilih
            $areaData = Area::where('area', $selectedArea)->first();

            if (!$areaData) {
                return response()->json(['error' => 'Area tidak ditemukan'], 404);
            }

            // Ambil data lokasi dari model UMR yang cocok dengan lokasi dari model Area
            $umrData = Umr::where('lokasi', $areaData->lokasi)->first();

            if ($umrData) {
                $umr = $umrData->umr;
                $bpjs_naker = $umr * 0.02; // 2% dari UMR
                $bpjs_nakes = $umr * 0.01; // 1% dari UMR
            } else {
                $bpjs_naker = 0;
                $bpjs_nakes = 0;
            }

            // Ambil data pengguna berdasarkan area yang dipilih
            $users = User::where('jabatan', 'anggota')
                ->where('area', $selectedArea)
                ->get();

            // Menghitung total absensi untuk setiap user
            $currentMonth = date('m');
            $currentYear = date('Y');

            foreach ($users as $user) {
                $totalAbsen = Presensi::where('nik', $user->nik)
                    ->whereYear('created_at', $currentYear)
                    ->whereMonth('created_at', $currentMonth)
                    ->count();

                // Menambahkan total absensi dan gaji pokok serta tunjangan dari model Area
                $user->total_absen = $totalAbsen;
                $user->gaji = $areaData->gaji;
                $user->tunj_makan = $areaData->tunj_makan;
                $user->tunj_trans = $areaData->tunj_trans;
                $user->bpjs_naker = $bpjs_naker;
                $user->bpjs_nakes = $bpjs_nakes;
            }

            return response()->json($users, 200);
        } catch (\Exception $e) {
            return response()->json(['error' => 'Internal Server Error'], 500);
        }
    }



    public function nonppn()
    {
        $area = Area::where('pajak', 'NON PPN')->get();
        return view('admin.keuangan.rgb.penggajian.nonppn', compact('area'));
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
