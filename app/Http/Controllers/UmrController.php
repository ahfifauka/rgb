<?php

namespace App\Http\Controllers;

use App\Models\Umr;
use Illuminate\Http\Request;

class UmrController extends Controller
{
    public function index()
    {
        $data = Umr::all();
        return view('admin.keuangan.umr.index', compact('data'));
    }

    public function store(Request $request)
    {
        $data = $request->all();
        Umr::create($data);
        return redirect()->route('umr.index')->with('success', 'Data berhasil di simpan');
    }

    public function edit($id)
    {
        $data = Umr::findOrFail($id);
        return view('admin.keuangan.umr.edit', compact('data'));
    }

    public function update($id, Request $request)
    {
        $data = Umr::findOrFail($id);
        $data2 = $request->all();
        $data->update($data2);
        return redirect()->route('umr.index')->with('success', 'Data berhasil di Perbaharui');
    }

    public function destroy($id)
    {
        $data = Umr::findOrFail($id);
        $data->delete();
        return redirect()->route('umr.index')->with('success', 'Data Berhasil di Hapus');
    }
}
