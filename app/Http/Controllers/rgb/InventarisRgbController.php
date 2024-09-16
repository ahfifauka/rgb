<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Area;
use Illuminate\Http\Request;
use App\Models\Inventaris;


class InventarisRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $inventaris = Inventaris::all();
        return view('admin.oprational.rgb.inventaris.index', compact('inventaris'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $data = Area::all();
        return view('admin.oprational.rgb.inventaris.create', compact('data'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $request->validate([
            'deskripsi_barang' => 'required|string|max:255',
            'lokasi' => 'required|string|max:255',
        ]);

        Inventaris::create([
            'deskripsi_barang' => rtrim($request->input('deskripsi_barang'), ', '),
            'lokasi' => $request->input('lokasi'),
        ]);

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil ditambahkan.');
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
    public function edit($id)
    {
        $inventaris = Inventaris::findOrFail($id);
        $data = Area::all();
        $barangList = explode(', ', $inventaris->deskripsi_barang);
        return view('admin.oprational.rgb.inventaris.edit', compact('inventaris', 'data', 'barangList'));
    }

    // Update the specified inventaris in storage
    public function update(Request $request, $id)
    {
        $request->validate([
            'deskripsi_barang' => 'required|string',
            'lokasi' => 'required|string',
        ]);

        $inventaris = Inventaris::findOrFail($id);
        $inventaris->deskripsi_barang = $request->input('deskripsi_barang');
        $inventaris->lokasi = $request->input('lokasi');
        $inventaris->save();

        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil diperbarui');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy($id)
    {
        $data = Inventaris::findOrFail($id);
        $data->delete();
        return redirect()->route('inventaris.index')->with('success', 'Inventaris berhasil dihapus.');
    }
}
