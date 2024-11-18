<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Jadwal;
use App\Models\Presensi;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Storage;
use Carbon\Carbon; // Make sure to import Carbon

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
            $timestamps = [];
            $today = now(); // Current date and time

            for ($i = 1; $i <= 31; $i++) {
                $date = now()->startOfMonth()->addDays($i - 1)->format('Y-m-d'); // Current month and year with day
                $presensi = $anggotaPresensi->firstWhere(function ($p) use ($date) {
                    return $p->created_at->format('Y-m-d') === $date;
                });

                if ($presensi) {
                    $status[$i] = 'M'; // Present
                    $timestamps[$i] = [
                        'created_at' => $presensi->created_at->format('H:i'),
                        'updated_at' => $presensi->updated_at->format('H:i'),
                    ];
                } else {
                    $status[$i] = $today->day < $i ? 'B' : 'TK'; // 'B' if the date is in the future, 'TK' otherwise
                    $timestamps[$i] = null;
                }
            }

            return [
                'name' => $anggota->name,
                'nik' => $anggota->nik,
                'area' => $anggota->area,
                'status' => $status,
                'timestamps' => $timestamps,
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

    public function detailA()
    {
        $data = Presensi::all();
        return view('admin.oprational.rgb.presensi.detail', compact('data'));
    }


    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $user = Auth::user();

        // Fetch the specific field from 'jadwal' where year, month, and day match the current date
        $jadwal = Jadwal::where('nik', $user->nik)
            ->whereYear('created_at', now()->year)  // Use now() directly for the current year
            ->whereMonth('created_at', now()->month) // Use now() directly for the current month
            ->first(); // Get the first matching record

        return view('user.anggota.presensi.index', compact('jadwal'));
    }



    /**
     * Store a newly created resource in storage.
     */

    public function store(Request $request)
    {
        // Validate the request data
        $validatedData = $request->validate([
            'captured_image' => 'required|string',
            'location' => 'required|string',
            'name' => 'required|string|max:255',
            'nik' => 'required|string|max:255',
            'area' => 'required|string|max:255',
            'bagian' => 'required|string|max:255',
            'sesi' => 'required|string',
            'ket1' => 'nullable|string',
        ]);

        // Handle the captured image
        $filename = null;
        if (preg_match('/^data:image\/(\w+);base64,/', $validatedData['captured_image'], $type)) {
            $data = substr($validatedData['captured_image'], strpos($validatedData['captured_image'], ',') + 1);
            $data = base64_decode($data);
            if ($data === false) {
                throw new \Exception('Base64 decode failed');
            }
            // Generate a filename
            $filename = 'captured_image_' . time() . '.png';

            // Store the image in the storage/app/public/images directory
            Storage::disk('public')->put('images/' . $filename, $data);
        }

        // Create a new entry in the presensi table
        $presensi = new Presensi(); // Replace with your actual model
        $presensi->name = $validatedData['name'];
        $presensi->nik = $validatedData['nik'];
        $presensi->area = $validatedData['area'];
        $presensi->bagian = $validatedData['bagian'];
        $presensi->sesi = $validatedData['sesi'];
        $presensi->ket1 = $validatedData['ket1'];
        $presensi->ket2 = ''; // Set ket2 to an empty string
        $presensi->location = $validatedData['location'];

        // Store the path of the captured image
        $presensi->image = 'storage/images/' . $filename; // Store the path of the captured image
        $presensi->save();

        // Redirect back with a success message
        return redirect()->route('presensi.create')->with('success', 'Presensi has been recorded successfully!');
    }



    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        $data = Presensi::where('nik', $user->nik)->get();
        return view('user.anggota.presensi.data', compact('data'));
    }


    public function pulang($id)
    {
        $data = Presensi::findOrFail($id);
        $data->ket2 = 'pulang';
        // Save the changes to the database
        $data->save();
        // Optionally, you might want to redirect back with a success message
        return redirect()->route('anggota.index')->with('success', 'Presensi has been updated to pulang successfully!');
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
