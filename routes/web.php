<?php

use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HrdController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\OprationalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\rbm\KeuanganRbmController;
use App\Http\Controllers\rgb\AkunRgbController;
use App\Http\Controllers\rgb\DataRgbController;
use App\Http\Controllers\rgb\KeuanganRgbController;
use App\Models\User;
//rgb

//
use Illuminate\Support\Facades\Route;

Route::get('/', function () {
    return view('auth.login');
});

Route::get('/dashboard', [DashboardController::class, 'index'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');

    //keuangan
    Route::get('keuangan', [KeuanganController::class, 'index'])->name('keuangan.index');
    Route::get('keuangan/rgb', [KeuanganController::class, 'rgb'])->name('keuangan.rgb');
    Route::get('keuangan/rbm', [KeuanganController::class, 'rbm'])->name('keuangan.rbm');

    //oprational
    Route::get('oprational', [OprationalController::class, 'index'])->name('oprational.index');
    Route::get('oprational/rgb', [OprationalController::class, 'rgb'])->name('oprational.rgb');
    Route::get('oprational/rbm', [OprationalController::class, 'rbm'])->name('oprational.rbm');

    //hrd
    Route::get('hrd', [HrdController::class, 'index'])->name('hrd.index');
    Route::get('hrd/rgb', [HrdController::class, 'rgb'])->name('hrd.rgb');
    Route::get('hrd/rbm', [HrdController::class, 'rbm'])->name('hrd.rbm');
    //hrd-akun-rgb
    Route::resource('AkunRgb', AkunRgbController::class);
    //hrd-data-rgb
    Route::resource('DataRgb', DataRgbController::class);
    Route::get('/last-id', function () {
        // Retrieve the last account's NIK
        $lastAccount = User::orderBy('id', 'desc')->first();
        // Return the last NIK or a default value if none exists
        return response()->json(['lastId' => $lastAccount->nik ?? 'RGB-86.10.00.0000']);
    })->name('last-id');

    //marketing
    Route::resource('marketing', MarketingController::class);
});

require __DIR__ . '/auth.php';
