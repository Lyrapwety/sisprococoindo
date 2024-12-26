<?php

use App\Http\Controllers\DatapegawaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporandkpController;
use App\Http\Controllers\LaporandkprejectController;
use App\Http\Controllers\LaporankulitariController;
use App\Http\Controllers\LaporantempurungController;
use App\Http\Controllers\ProduksisantanController;
use App\Http\Controllers\ProduksiairkelapaController;
use App\Http\Controllers\StokdkpController;
use App\Http\Controllers\RekapkulitariController;
use App\Http\Controllers\StokarikeringController;
use App\Http\Controllers\StokaribasahController;
use App\Http\Controllers\StokminyakkelapaController;
use App\Http\Controllers\StokrejectkeringController;
use App\Http\Controllers\StokrejectbasahController;
use App\Http\Controllers\StoktempurungbasahController;
use App\Http\Controllers\StokKbController;
use App\Http\Controllers\StokampasputihController;
use App\Http\Controllers\StokampasyellowController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\LaporanairkelapaController;
use App\Http\Controllers\DashboardController;
use App\Http\Controllers\StoksantanController;
use App\Http\Controllers\StokairkelapaController;
use App\Http\Controllers\KelapabulatController;

Route::get('/', function () {
    return view('welcome');
});



Route::get('/dashboard', [DashboardController::class, 'dashboard'])
    ->middleware(['auth', 'verified'])
    ->name('dashboard');

Route::middleware('auth')->group(function () {
    Route::get('/profile', [ProfileController::class, 'edit'])->name('profile.edit');
    Route::patch('/profile', [ProfileController::class, 'update'])->name('profile.update');
    Route::delete('/profile', [ProfileController::class, 'destroy'])->name('profile.destroy');
});

//laporan view
Route::prefix('laporan')->name('laporan.')->group(function () {
    //laporan dkp
    Route::resource('dkp', LaporandkpController::class);
    Route::get('dkp/create', [LaporandkpController::class, 'create'])->name('dkp.create');
    Route::post('dkp', [LaporandkpController::class, 'store'])->name('dkp.store');
    Route::delete('dkp/{id}', [LaporandkpController::class, 'destroy'])->name('dkp.destroy');
    Route::get('dkp/{id}/edit', [LaporandkpController::class, 'edit'])->name('dkp.edit');
    Route::get('/laporan/dkp/{id}', [LaporandkpController::class, 'show'])->name('laporan.dkp.show');
    Route::put('/laporan/dkp/{id}', [LaporandkpController::class, 'update'])->name('laporan.dkp.update');


    //dkp reject
    Route::resource('dkp_reject', LaporandkprejectController::class);
    Route::get('dkp_reject/create', [LaporandkprejectController::class, 'create'])->name('dkp.create');
    Route::post('dkp_reject', [LaporandkprejectController::class, 'store'])->name('dkp_reject.store');
    Route::delete('dkp_reject/{id}', [LaporandkprejectController::class, 'destroy'])->name('dkp_reject.destroy');
    Route::get('dkp_reject/{id}/edit', [LaporandkprejectController::class, 'edit'])->name('dkp_reject.edit');
    Route::put('/laporan/dkp_reject/{id}', [LaporandkprejectController::class, 'update'])->name('laporan.dkp_reject.update');

    //kulit ari laporan
    Route::resource('kulitari', LaporankulitariController::class);
    Route::get('kulitari/create', [LaporankulitariController::class, 'create'])->name('kulitari.create');
    Route::post('kulitari', [LaporankulitariController::class, 'store'])->name('kulitari.store');
    Route::delete('kulitari/{id}', [LaporankulitariController::class, 'destroy'])->name('kulitari.destroy');
    Route::get('kulitari/{id}/edit', [LaporankulitariController::class, 'edit'])->name('kulitari.edit');
    Route::put('/laporan/kulitari/{id}', [LaporankulitariController::class, 'update'])->name('laporan.kulitari.update');

    //air kelapa laporan
    Route::resource('airkelapa', LaporanairkelapaController::class);
    Route::get('airkelapa/create', [LaporanairkelapaController::class, 'create'])->name('airkelapa.create');
    Route::post('airkelapa', [LaporanairkelapaController::class, 'store'])->name('airkelapa.store');
    Route::delete('airkelapa/{id}', [LaporanairkelapaController::class, 'destroy'])->name('airkelapa.destroy');
    Route::get('airkelapa/{id}/edit', [LaporanairkelapaController::class, 'edit'])->name('airkelapa.edit');
    Route::put('/laporan/airkelapa/{id}', [LaporanairkelapaController::class, 'update'])->name('laporan.airkelapa.update');

    //tempurung laporan
    Route::resource('tempurung', LaporantempurungController::class);
    Route::get('tempurung/create', [LaporantempurungController::class, 'create'])->name('tempurung.create');
    Route::post('tempurung', [LaporantempurungController::class, 'store'])->name('tempurung.store');
    Route::delete('tempurung/{id}', [LaporantempurungController::class, 'destroy'])->name('tempurung.destroy');
    Route::get('tempurung/{id}/edit', [LaporantempurungController::class, 'edit'])->name('tempurung.edit');
    Route::put('/laporan/tempurung/{id}', [LaporantempurungController::class, 'update'])->name('laporan.tempurung.update');
});

//rekap view
Route::prefix('rekap_laporan')->name('rekap_laporan.')->group(function () {
    //rekap kulit ari
    Route::resource('pembukaan_kulit_ari', RekapkulitariController::class);
    Route::get('pembukaan_kulit_ari/create', [RekapkulitariController::class, 'create'])->name('pembukaan_kulit_ari.create');
    Route::post('pembukaan_kulit_ari', [RekapkulitariController::class, 'store'])->name('pembukaan_kulit_ari.store');
    Route::delete('pembukaan_kulit_ari/{id}', [RekapkulitariController::class, 'destroy'])->name('pembukaan_kulit_ari.destroy');
});

//produksi view
Route::prefix('produksi')->name('produksi.')->group(function () {
    //produksi santan
    Route::resource('santan', ProduksisantanController::class);
    Route::get('santan/create', [ProduksisantanController::class, 'create'])->name('santan.create');
    Route::post('santan', [ProduksisantanController::class, 'store'])->name('santan.store');
    Route::delete('santan/{id}', [ProduksisantanController::class, 'destroy'])->name('santan.destroy');

    //produksi airkelapa
    Route::resource('air_kelapa', ProduksiairkelapaController::class);
    Route::get('air_kelapa/create', [ProduksiairkelapaController::class, 'create'])->name('air_kelapa.create');
    Route::post('air_kelapa', [ProduksiairkelapaController::class, 'store'])->name('air_kelapa.store');
    Route::delete('air_kelapa/{id}', [ProduksiairkelapaController::class, 'destroy'])->name('air_kelapa.destroy');
});

//stok view
Route::prefix('card_stock')->name('card_stock.')->group(function () {
    //stok dkp
    Route::resource('dkp', StokdkpController::class);
    Route::get('dkp/create', [StokdkpController::class, 'create'])->name('dkp.create');
    Route::post('dkp', [StokdkpController::class, 'store'])->name('dkp.store');
    Route::delete('dkp/{id}', [StokdkpController::class, 'destroy'])->name('dkp.destroy');
    Route::get('dkp/{id}/edit', [StokdkpController::class, 'edit'])->name('dkp.edit');
    Route::put('/stok/dkp/{id}', [StokdkpController::class, 'update'])->name('stok.dkp.update');

    //stok kelapa bulat
    Route::resource('kelapa_bulat', KelapabulatController::class);
    Route::get('kelapa_bulat/create', [KelapabulatController::class, 'create'])->name('kelapa_bulat.create');
    Route::post('kelapa_bulat', [KelapabulatController::class, 'store'])->name('kelapa_bulat.store');
    Route::delete('kelapa_bulat/{id}', [KelapabulatController::class, 'destroy'])->name('kelapa_bulat.destroy');
    Route::get('/kelapa_bulat/{id}', [KelapabulatController::class, 'getPreviousData'])->name('kelapa_bulat.previous');

    //stok kb
    Route::resource('KB_Kelapa_Bulat', StokKbController::class);
    Route::get('KB_Kelapa_Bulat/create', [StokKbController::class, 'create'])->name('KB_Kelapa_Bulat.create');
    Route::post('KB_Kelapa_Bulat', [StokKbController::class, 'store'])->name('KB_Kelapa_Bulat.store');
    Route::delete('KB_Kelapa_Bulat/{id}', [StokKbController::class, 'destroy'])->name('KB_Kelapa_Bulat.destroy');
    Route::get('KB_Kelapa_Bulat/{id}/edit', [StokKbController::class, 'edit'])->name('KB_Kelapa_Bulat.edit');
    Route::put('/stok/kb/{id}', [StokkbController::class, 'update'])->name('stok.kb.update');

    //stok santan
    Route::resource('santan', StoksantanController::class);
    Route::get('santan/create', [StoksantanController::class, 'create'])->name('santan.create');
    Route::post('santan', [StoksantanController::class, 'store'])->name('santan.store');
    Route::delete('santan/{id}', [StoksantanController  ::class, 'destroy'])->name('santan.destroy');

    //stok air kelapa
    Route::resource('air_kelapa', StokairkelapaController::class);
    Route::get('air_kelapa/create', [StokairkelapaController::class, 'create'])->name('air_kelapa.create');
    Route::post('air_kelapa', [StokairkelapaController::class, 'store'])->name('air_kelapa.store');
    Route::delete('air_kelapa/{id}', [StokairkelapaController  ::class, 'destroy'])->name('air_kelapa.destroy');

    //stok ari kering
    Route::resource('kulit_ari_kering', StokarikeringController::class);
    Route::get('kulit_ari_kering/create', [StokarikeringController::class, 'create'])->name('kulit_ari_kering.create');
    Route::post('kulit_ari_kering', [StokarikeringController::class, 'store'])->name('kulit_ari_kering.store');
    Route::delete('kulit_ari_kering/{id}', [StokarikeringController::class, 'destroy'])->name('kulit_ari_kering.destroy');
    Route::get('kulit_ari_kering/{id}/edit', [StokdkpController::class, 'edit'])->name('kulit_ari_kering.edit');
    Route::put('/stok/kulit-ari-kering/{id}', [StokarikeringController::class, 'update'])->name('stok.kulit_ari_kering.update');


    //stok ari basah
    Route::resource('kulit_ari_basah', StokaribasahController::class);
    Route::get('kulit_ari_basah/create', [StokaribasahController::class, 'create'])->name('kulit_ari_basah.create');
    Route::post('kulit_ari_basah', [StokaribasahController::class, 'store'])->name('kulit_ari_basah.store');
    Route::delete('kulit_ari_basah/{id}', [StokaribasahController::class, 'destroy'])->name('kulit_ari_basah.destroy');
    Route::get('kulit_ari_basah/{id}/edit', [StokaribasahController::class, 'edit'])->name('kulit_ari_basah.edit');
    Route::put('/stok/kulit-ari-basah/{id}', [StokaribasahController::class, 'update'])->name('stok.kulit_ari_basah.update');

    //stok minyak kelapa
    Route::resource('minyak_kelapa', StokminyakkelapaController::class);
    Route::get('minyak_kelapa/create', [StokminyakkelapaController::class, 'create'])->name('minyak_kelapa.create');
    Route::post('minyak_kelapa', [StokminyakkelapaController::class, 'store'])->name('minyak_kelapa.store');
    Route::delete('minyak_kelapa/{id}', [StokminyakkelapaController::class, 'destroy'])->name('minyak_kelapa.destroy');
    Route::get('minyak_kelapa/{id}/edit', [StokminyakkelapaController::class, 'edit'])->name('minyak_kelapa.edit');
    Route::put('/stok/minyak-kelapa/{id}', [StokminyakkelapaController::class, 'update'])->name('stok.minyak_kelapa.update');


    //stok reject kering
    Route::resource('dkp_reject_kering', StokrejectkeringController::class);
    Route::get('dkp_reject_kering/create', [StokrejectkeringController::class, 'create'])->name('dkp_reject_kering.create');
    Route::post('dkp_reject_kering', [StokrejectkeringController::class, 'store'])->name('dkp_reject_kering.store');
    Route::delete('dkp_reject_kering/{id}', [StokrejectkeringController::class, 'destroy'])->name('dkp_reject_kering.destroy');
    Route::get('dkp_reject_kering/{id}/edit', [StokrejectkeringController::class, 'edit'])->name('dkp_reject_kering.edit');
    Route::put('/stok/reject-kering/{id}', [StokrejectkeringController::class, 'update'])->name('stok.reject_kering.update');


    //stok reject basah
    Route::resource('dkp_reject_basah', StokrejectbasahController::class);
    Route::get('dkp_reject_basah/create', [StokrejectbasahController::class, 'create'])->name('dkp_reject_basah.create');
    Route::post('dkp_reject_basah', [StokrejectbasahController::class, 'store'])->name('dkp_reject_basah.store');
    Route::delete('dkp_reject_basah/{id}', [StokrejectbasahController::class, 'destroy'])->name('dkp_reject_basah.destroy');
    Route::get('dkp_reject_basah/{id}/edit', [StokrejectbasahController::class, 'edit'])->name('dkp_reject_basah.edit');
    Route::put('/stok/reject-basah/{id}', [StokrejectbasahController::class, 'update'])->name('stok.reject_basah.update');


    //stok tempurung
    Route::resource('tempurung_basah', StoktempurungbasahController::class);
    Route::get('tempurung_basah/create', [StoktempurungbasahController::class, 'create'])->name('tempurung_basah.create');
    Route::post('tempurung_basah', [StoktempurungbasahController::class, 'store'])->name('tempurung_basah.store');
    Route::delete('tempurung_basah/{id}', [StoktempurungbasahController::class, 'destroy'])->name('tempurung_basah.destroy');
    Route::get('tempurung_basah/{id}/edit', [StoktempurungbasahController::class, 'edit'])->name('tempurung_basah.edit');
    Route::put('/stok/tempurung-basah/{id}', [StoktempurungbasahController::class, 'update'])->name('stok.tempurung_basah.update');


    //stok ampas kering putih
    Route::resource('ampas_kering_putih', StokampasputihController::class);
    Route::get('ampas_kering_putih/create', [StokampasputihController::class, 'create'])->name('ampas_kering_putih.create');
    Route::post('ampas_kering_putih', [StokampasputihController::class, 'store'])->name('ampas_kering_putih.store');
    Route::delete('ampas_kering_putih/{id}', [StokampasputihController::class, 'destroy'])->name('ampas_kering_putih.destroy');
    Route::get('ampas_kering_putih/{id}/edit', [StokampasputihController::class, 'edit'])->name('ampas_kering_putih.edit');
    Route::put('/stok/ampas-kering-putih/{id}', [StokampasputihController::class, 'update'])->name('stok.ampas_kering_putih.update');


    //stok ampas kering putih
    Route::resource('ampas_kering_yellow', StokampasyellowController::class);
    Route::get('ampas_kering_yellow/create', [StokampasyellowController::class, 'create'])->name('ampas_kering_yellow.create');
    Route::post('ampas_kering_yellow', [StokampasyellowController::class, 'store'])->name('ampas_kering_yellow.store');
    Route::delete('ampas_kering_yellow/{id}', [StokampasyellowController::class, 'destroy'])->name('ampas_kering_yellow.destroy');
    Route::get('ampas_kering_yellow/{id}/edit', [StokampasyellowController::class, 'edit'])->name('ampas_kering_yellow.edit');
    Route::put('/stok/ampas-kering-yellow/{id}', [StokampasyellowController::class, 'update'])->name('stok.ampas_kering_yellow.update');

});



Route::prefix('data_pegawai')->name('data_pegawai.')->group(function () {
    Route::get('/', [DatapegawaiController::class, 'index'])->name('index');
    Route::get('/tambah_data_pegawai', [DatapegawaiController::class, 'tambah_data_pegawai'])->name('tambah_data_pegawai');
    Route::post('/store', [DatapegawaiController::class, 'store'])->name('store');
    Route::delete('/{id}', [DatapegawaiController::class, 'destroy'])->name('destroy');
    Route::get('/edit/{id}', [DatapegawaiController::class, 'edit'])->name('edit');
    Route::put('/update/{id}', [DatapegawaiController::class, 'update'])->name('update');
});


require __DIR__.'/auth.php';
