<?php

namespace App\Http\Controllers\rgb;

use App\Http\Controllers\Controller;
use App\Models\Patroli;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class PatroliRgbController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $data = User::where('jabatan', 'anggota')->get();
        return view('admin.oprational.rgb.patroli.index', compact('data'));
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
        // Handle photo uploads
        
    }

    /**
     * Display the specified resource.
     */
    public function show($id)
    {
        //
    }
    public function detail($nik)
    {
        // Ambil semua data patroli dengan nik yang sama
        $patrolData = Patroli::where('nik', $nik)->get();

        // Kirim data ke tampilan
        return view('admin.oprational.rgb.patroli.detail', compact('patrolData', 'nik'));
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
