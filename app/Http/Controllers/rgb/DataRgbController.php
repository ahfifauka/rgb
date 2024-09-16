<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;

class DataRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::all();
        return view('admin.hrd.rgb.data.index', [
            'data' => $data,
        ]);
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Area::all();
        return view('admin.hrd.rgb.data.data', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        // Ambil semua data inputan form
        $data = $request->all();

        // Hash password menggunakan Hash facade bawaan Laravel
        $data['password'] = Hash::make($request->nik);

        // Menggabungkan sim_option jika ada pilihan SIM yang di-check
        if ($request->has('sim_option')) {
            $data['sim'] = implode(',', $request->sim_option);
        }

        if ($request->has('kta_option')) {
            $data['kta'] = implode(',', $request->kta_option);
        }

        if ($request->has('ijazah') && $request->has('ijazah_level')) {
            $data['ijazah'] = $request->ijazah_level;
        }

        // Simpan data ke dalam database
        User::create($data);

        // Redirect atau berikan response setelah data tersimpan
        return redirect()->route('DataRgb.index')->with('success', 'Data berhasil disimpan.');
    }


    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        $user = User::findOrFail($id);
        return view('admin.hrd.rgb.data.detail', compact('user'));
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $account = User::findOrFail($id);
        $data = Area::all();

        // Return the edit view with the account data
        return view('admin.hrd.rgb.data.edit', compact('account', 'data'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $account = User::findOrFail($id);

        // Ambil semua data inputan form
        $data = $request->all();

        // Jika ingin mengupdate password, kita hash password menggunakan Hash facade Laravel
        // Sesuai dengan logika Anda, password di-hash berdasarkan NIK
        if ($request->has('nik')) {
            $data['password'] = Hash::make($request->nik);
        }

        // Menggabungkan sim_option jika ada pilihan SIM yang di-check
        if ($request->has('sim_option')) {
            $data['sim'] = implode(',', $request->sim_option);
        } else {
            $data['sim'] = null;
        }

        // Menggabungkan kta_option jika ada pilihan KTA yang di-check
        if ($request->has('kta_option')) {
            $data['kta'] = implode(',', $request->kta_option);
        } else {
            $data['kta'] = null;
        }

        // Jika ijazah dan level ijazah diinput, set sesuai input
        if ($request->has('ijazah') && $request->has('ijazah_level')) {
            $data['ijazah'] = $request->ijazah_level;
        }

        // Update data ke dalam database
        $account->update($data);

        // Redirect atau berikan response setelah data tersimpan
        return redirect()->route('DataRgb.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = User::findOrFail($id);
        $data->delete();
        return redirect()->route('DataRgb.index')->with('success', 'Data Berhasil dihapus');
    }
}
