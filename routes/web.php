<?php

use App\Http\Controllers\DatapegawaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporandkpController;
use App\Http\Controllers\LaporandkprejectController;
use App\Http\Controllers\LaporankulitariController;
use App\Http\Controllers\LaporantempurungController;
use App\Http\Controllers\ProduksisantanController;
use App\Http\Controllers\ProduksiairkelapaController;
use App\Http\Controllers\StokdkpController;
use App\Http\Controllers\RekapkulitariController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\StockController;
use App\Http\Controllers\LaporanairkelapaController;


Route::get('/', function () {
    return view('welcome');
});

Route::get('/dashboard', function () {
    return view('dashboard');
})->middleware(['auth', 'verified'])->name('dashboard');

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
    Route::put('dkp/{id}', [LaporandkpController::class, 'update'])->name('dkp.update');

    //dkp reject
    Route::resource('dkp_reject', LaporandkprejectController::class);
    Route::get('dkp_reject/create', [LaporandkprejectController::class, 'create'])->name('dkp.create');
    Route::post('dkp_reject', [LaporandkprejectController::class, 'store'])->name('dkp_reject.store');
    Route::delete('dkp_reject/{id}', [LaporandkprejectController::class, 'destroy'])->name('dkp_reject.destroy');

    //kulit ari laporan
    Route::resource('kulitari', LaporankulitariController::class);
    Route::get('kulitari/create', [LaporankulitariController::class, 'create'])->name('kulitari.create');
    Route::post('kulitari', [LaporankulitariController::class, 'store'])->name('kulitari.store');
    Route::delete('kulitari/{id}', [LaporankulitariController::class, 'destroy'])->name('kulitari.destroy');

    //air kelapa laporan
    Route::resource('airkelapa', LaporanairkelapaController::class);
    Route::get('airkelapa/create', [LaporanairkelapaController::class, 'create'])->name('airkelapa.create');
    Route::post('airkelapa', [LaporanairkelapaController::class, 'store'])->name('airkelapa.store');
    Route::delete('airkelapa/{id}', [LaporanairkelapaController::class, 'destroy'])->name('airkelapa.destroy');

    //tempurung laporan
    Route::resource('tempurung', LaporantempurungController::class);
    Route::get('tempurung/create', [LaporantempurungController::class, 'create'])->name('tempurung.create');
    Route::post('tempurung', [LaporantempurungController::class, 'store'])->name('tempurung.store');
    Route::delete('tempurung/{id}', [LaporantempurungController::class, 'destroy'])->name('tempurung.destroy');
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

//produksi stok
Route::prefix('card_stock')->name('card_stock.')->group(function () {
    //stok dkp
    Route::resource('dkp', StokdkpController::class);
    Route::get('dkp/create', [StokdkpController::class, 'create'])->name('dkp.create');
    Route::post('dkp', [StokdkpController::class, 'store'])->name('dkp.store');
    Route::delete('dkp/{id}', [StokdkpController::class, 'destroy'])->name('dkp.destroy');

    //produksi airkelapa
    Route::resource('air_kelapa', ProduksiairkelapaController::class);
    Route::get('air_kelapa/create', [ProduksiairkelapaController::class, 'create'])->name('air_kelapa.create');
    Route::post('air_kelapa', [ProduksiairkelapaController::class, 'store'])->name('air_kelapa.store');
    Route::delete('air_kelapa/{id}', [ProduksiairkelapaController::class, 'destroy'])->name('air_kelapa.destroy');
});


Route::get('/card_stock/santan', [StockController::class, 'santan'])->name('card_stock.santan');
Route::get('/card_stock/dkp_reject_kering', [StockController::class, 'dkp_reject_kering'])->name('card_stock.dkp_reject_kering');
Route::get('/card_stock/dkp_reject_basah', [StockController::class, 'dkp_reject_basah'])->name('card_stock.dkp_reject_basah');
Route::get('/card_stock/minyak_kelapa', [StockController::class, 'minyak_kelapa'])->name('card_stock.minyak_kelapa');
Route::get('/card_stock/air_kelapa', [StockController::class, 'air_kelapa'])->name('card_stock.air_kelapa');
Route::get('/card_stock/kelapa_bulat', [StockController::class, 'kelapa_bulat'])->name('card_stock.kelapa_bulat');
Route::get('/card_stock/KB_Kelapa_Bulat', [StockController::class, 'kb_kelapa_bulat'])->name('card_stock.KB_Kelapa_Bulat');
Route::get('/card_stock/tempurung_basah', [StockController::class, 'tempurung_basah'])->name('card_stock.tempurung_basah');
Route::get('/card_stock/kulit_ari_basah', [StockController::class, 'kulit_ari_basah'])->name('card_stock.kulit_ari_basah');
Route::get('/card_stock/kulit_ari_kering', [StockController::class, 'kulit_ari_kering'])->name('card_stock.kulit_ari_kering');
Route::get('/card_stock/ampas_kering_putih', [StockController::class, 'ampas_kering_putih'])->name('card_stock.ampas_kering_putih');
Route::get('/card_stock/ampas_kering_yellow', [StockController::class, 'ampas_kering_yellow'])->name('card_stock.ampas_kering_yellow');


Route::prefix('data_pegawai')->name('data_pegawai.')->group(function () {
    Route::get('/', [DatapegawaiController::class, 'index'])->name('index');
    Route::get('/tambah_data_pegawai', [DatapegawaiController::class, 'tambah_data_pegawai'])->name('tambah_data_pegawai');
    Route::post('/store', [DatapegawaiController::class, 'store'])->name('store');
    Route::delete('/{id}', [DatapegawaiController::class, 'destroy'])->name('destroy');
});


Route::get('/edit_data_pegawai', [DatapegawaiController::class, 'edit_data_pegawai'])->name('edit_data_pegawai');

require __DIR__.'/auth.php';
