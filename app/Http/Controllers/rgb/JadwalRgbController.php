<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Jadwal;
use App\Models\User;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;


class JadwalRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Jadwal::all();
        return view('admin.oprational.rgb.jadwal.index', compact('data'));
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
            Jadwal::updateOrCreate(
                ['nik' => $row[2]], // Cari berdasarkan NIK
                [
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
                ]
            );
        }

        return redirect()->back()->with('success', 'Template successfully uploaded and processed.');
    }
}
