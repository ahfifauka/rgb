<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use App\Models\Umr;
use Illuminate\Http\Request;


class AreaRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = Area::all();
        $lokasi = Umr::all();
        return view('admin.keuangan.rgb.area.index', compact('data', 'lokasi'));
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
        $data = $request->all();
        Area::create($data);
        return redirect()->route('Area.index')->with('success', 'Data Berhasil Disimpan');
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
        $data = Area::findOrFail($id); // Ambil data berdasarkan ID
        $lokasi = Umr::all();
        return view('admin.keuangan.rgb.area.edit', compact('data', 'lokasi')); // Arahkan ke halaman edit dan kirim data

    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $data = Area::findOrFail($id);
        $data->update($request->all());

        return redirect()->route('Area.index')->with('success', 'Data berhasil diperbarui.');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $data = Area::findOrFail($id);
        $data->delete();
        return redirect()->route('Area.index')->with('success', 'Data Berhasil Dihapus');
    }
}
