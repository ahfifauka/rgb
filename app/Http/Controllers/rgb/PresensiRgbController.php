<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;

class PresensiRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $anggota = User::where('jabatan', 'anggota')->get(['name', 'nik', 'area']);
        $presensiData = Presensi::whereIn('nik', $anggota->pluck('nik'))->get();

        $data = $anggota->map(function ($anggota) use ($presensiData) {
            $anggotaPresensi = $presensiData->where('nik', $anggota->nik);
            $status = [];
            $today = now(); // Current date and time

            for ($i = 1; $i <= 31; $i++) {
                $date = now()->startOfMonth()->addDays($i - 1)->format('Y-m-d'); // Current month and year with day
                $presensi = $anggotaPresensi->firstWhere(function ($p) use ($date) {
                    return $p->created_at->format('Y-m-d') === $date;
                });

                if ($presensi) {
                    $status[$i] = 'M'; // Present
                } else {
                    $status[$i] = $today->day < $i ? 'B' : 'TK'; // 'B' if the date is in the future, 'TK' otherwise
                }
            }

            return [
                'name' => $anggota->name,
                'nik' => $anggota->nik,
                'area' => $anggota->area,
                'status' => $status,
                'counts' => [
                    'M' => array_count_values($status)['M'] ?? 0,
                    'TK' => array_count_values($status)['TK'] ?? 0,
                    'B' => array_count_values($status)['B'] ?? 0,
                ],
            ];
        });

        return view('admin.oprational.rgb.presensi.index', [
            'data' => $data,
        ]);
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
