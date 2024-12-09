<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Patroli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class PatroliController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $user = Auth::user();
        $data = Patroli::where('nik', $user->nik)->get();
        return view('user.anggota.patroli.index', compact('data'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        return view('user.anggota.patroli.create');
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $areaPhotoPath = $request->file('foto_sekitar') ? $request->file('foto_sekitar')->store('patroli', 'public') : null;
        $personPhotoPath = $request->file('foto_anggota') ? $request->file('foto_anggota')->store('patroli', 'public') : null;

        // Create a new Patroli record (assuming you have a Patroli model)
        Patroli::create([
            'name' => $request->input('name'),
            'nik' => $request->input('nik'),
            'lokasi' => $request->input('lokasi'),
            'foto_sekitar' => $areaPhotoPath,
            'foto_anggota' => $personPhotoPath,
            'situasi' => $request->input('situasi'),
            'keterangan' => $request->input('keterangan'),
        ]);

        // Redirect or return response
        return redirect()->route('patroliU.create')->with('success', 'Data Patroli successfully saved!');
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
