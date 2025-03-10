<?php

//luaran/RGB & RBM

use App\Http\Controllers\AnggotaController;
use App\Http\Controllers\DanruController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\HrdController;
use App\Http\Controllers\KeuanganController;
use App\Http\Controllers\KorwilController;
use App\Http\Controllers\MarketingController;
use App\Http\Controllers\OprationalController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\UmrController;
//RBM/Controller
use App\Http\Controllers\rbm\KeuanganRbmController;
//RGB/Controller
use App\Http\Controllers\rgb\AkunRgbController;
use App\Http\Controllers\rgb\AreaRgbController;
use App\Http\Controllers\rgb\DataRgbController;
use App\Http\Controllers\rgb\InventarisRgbController;
use App\Http\Controllers\rgb\InvoiceRgbController;
use App\Http\Controllers\rgb\JadwalRgbController;
use App\Http\Controllers\rgb\KasRgbController;
use App\Http\Controllers\rgb\KeuanganRgbController;
use App\Http\Controllers\rgb\LaporanRgbController;
use App\Http\Controllers\rgb\MarketingPlanRgbController;
use App\Http\Controllers\rgb\PatroliController;
use App\Http\Controllers\rgb\PatroliRgbController;
use App\Http\Controllers\rgb\PenggajianRgbController;
use App\Http\Controllers\rgb\PresensiRgbController;
use App\Http\Controllers\rgb\TimeScheduleRgbController;
use App\Http\Controllers\SuratController;
use App\Models\Invoice;
use App\Models\Presensi;
use App\Models\Surat;
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

    //keuangan-umr
    Route::get('umr/index', [UmrController::class, 'index'])->name('umr.index');
    Route::post('umr/store', [UmrController::class, 'store'])->name('umr.store');
    Route::get('umr/edit/{id}', [UmrController::class, 'edit'])->name('umr.edit');
    Route::put('umr/update/{id}', [UmrController::class, 'update'])->name('umr.update');
    Route::delete('umr/destroy/{id}', [UmrController::class, 'destroy'])->name('umr.destroy');

    //keuangan-area
    Route::resource('Area', AreaRgbController::class);
    Route::get('cetak/area', [AreaRgbController::class, 'cetak'])->name('cetak.area');

    //keuangan-kas
    Route::resource('kas', KasRgbController::class);
    Route::get('cetak/kas', [KasRgbController::class, 'cetak'])->name('cetak.kas');

    //keuangan-penggajian
    Route::resource('penggajian', PenggajianRgbController::class);
    //keuangan-penggajian-ppn
    Route::get('ppn/penggajian', [PenggajianRgbController::class, 'ppn'])->name('ppn.penggajian');
    Route::get('/get-users-by-area', [PenggajianRgbController::class, 'getUsersByArea'])->name('getUsersByArea');
    //keuangan-penggajian-nonppn
    Route::get('nonppn/penggajian', [PenggajianRgbController::class, 'nonppn'])->name('non.penggajian');

    //keuangan-Invoice
    Route::resource('invoice', InvoiceRgbController::class);
    Route::get('cetak/invoice', [InvoiceRgbController::class, 'cetak'])->name('cetak.invoice');
    Route::get('laporan/invoice/{id}', [InvoiceRgbController::class, 'laporan'])->name('laporan.invoice');


    //oprational
    Route::get('oprational', [OprationalController::class, 'index'])->name('oprational.index');
    Route::get('oprational/rgb', [OprationalController::class, 'rgb'])->name('oprational.rgb');
    Route::get('oprational/rbm', [OprationalController::class, 'rbm'])->name('oprational.rbm');
    //oprational-presensi
    Route::resource('presensi', PresensiRgbController::class);
    Route::get('/detail/presensi', [PresensiRgbController::class, 'detailA'])->name('detail.admin');
    Route::post('/laporan-presensi', [PresensiRgbController::class, 'generateLaporanPresensi'])->name('laporan.presensi');
    //oprational-patroli
    Route::resource('patroli', PatroliRgbController::class);
    Route::get('show/patroli/{nik}', [PatroliRgbController::class, 'detail'])->name('show.patroli');

    //oprational-jadwal
    Route::resource('jadwal', JadwalRgbController::class);
    Route::get('/users-jadwal-by-area', [JadwalRgbController::class, 'getUsersByArea']);
    Route::post('/upload-template', [JadwalRgbController::class, 'uploadTemplate'])->name('upload.template');
    Route::post('/laporan-jadwal', [JadwalRgbController::class, 'generateLaporanJadwal'])->name('laporan.jadwal');
    //oprational-inventaris
    Route::resource('inventaris', InventarisRgbController::class);

    //hrd
    Route::get('hrd', [HrdController::class, 'index'])->name('hrd.index');
    Route::get('hrd/rgb', [HrdController::class, 'rgb'])->name('hrd.rgb');
    Route::get('hrd/rbm', [HrdController::class, 'rbm'])->name('hrd.rbm');
    //hrd-akun-rgb
    Route::resource('AkunRgb', AkunRgbController::class);
    //hard-akun-surat
    Route::get('/api/generate-no-surat/{status}', [SuratController::class, 'generateNoSurat']);
    Route::post('/surat/store', [SuratController::class, 'store'])->name('surat.store');
    Route::get('/surat/cetak/real/{nik}', [SuratController::class, 'real'])->name('suratR.cetak');
    Route::get('/surat/cetak/sementara/{nik}', [SuratController::class, 'sementara'])->name('suratS.cetak');
    //hrd-akun-surat peringatan
    Route::get('/surat/peringatan/{id}', [SuratController::class, 'peringatan'])->name('peringatan');
    Route::post('/surat/peringatan/post', [SuratController::class, 'peringatanp'])->name('peringatan.post');
    Route::get('/surat/peringatan/cetak/{nik}', [SuratController::class, 'peringatanc'])->name('peringatan.cetak');
    //hrd-akun-surat teguran
    Route::get('/surat/teguran/{id}', [SuratController::class, 'teguran'])->name('teguran');
    Route::post('/surat/teguran/post', [SuratController::class, 'teguranp'])->name('teguran.post');
    Route::get('/surat/teguran/cetak/{nik}', [SuratController::class, 'teguranc'])->name('teguran.cetak');
    //hrd-akun-pkwt
    Route::get('/surat/pkwt/{id}', [SuratController::class, 'pkwt'])->name('pkwt');
    Route::post('/surat/pkwt/post', [SuratController::class, 'pkwtp'])->name('pkwt.post');
    Route::get('/surat/pkwt/cetak/{nik}', [SuratController::class, 'pkwtc'])->name('pkwt.cetak');


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
    Route::get('/rgb/marketing', [MarketingController::class, 'rgb'])->name('rgb.Marketing');
    Route::get('/rbm/marketing', [MarketingController::class, 'rbm'])->name('rbm.Marketing');
    //marketing-marketing_plan
    Route::resource('MarketingPlan', MarketingPlanRgbController::class);
    //marketing-timeschedule
    Route::resource('TimeSchedule', TimeScheduleRgbController::class);
    //marketing-laporan_harian
    Route::resource('laporan', LaporanRgbController::class);




    //anggota atau users
    Route::resource('anggota', AnggotaController::class);
    Route::get('/pulang/{id}', [PresensiRgbController::class, 'pulang'])->name('presensi.pulang');
    Route::post('/izin/anggota', [PresensiRgbController::class, 'izin'])->name('izin.anggota.store');
    Route::resource('patroliU', PatroliController::class);
    //anggota-danru
    Route::resource('danru', DanruController::class);
    //anggota-Korwil
    Route::resource('korwil', KorwilController::class);
});

require __DIR__ . '/auth.php';
