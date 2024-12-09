<?php

use App\Http\Controllers\DatapegawaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
use App\Http\Controllers\LaporandkpController;
use App\Http\Controllers\RekapController;
use App\Http\Controllers\ProduksiController;
use App\Http\Controllers\StockController;


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

Route::prefix('laporan')->name('laporan.')->group(function () {
    Route::resource('dkp', LaporandkpController::class);
    Route::get('dkp/create', [LaporandkpController::class, 'create'])->name('dkp.create');
    Route::post('dkp', [LaporandkpController::class, 'store'])->name('dkp.store');
});
Route::get('/laporan/kulitari', [LaporanController::class, 'kulitari'])->name('laporan.kulitari');
Route::get('/laporan/airkelapa', [LaporanController::class, 'airkelapa'])->name('laporan.airkelapa');
Route::get('/laporan/tempurung', [LaporanController::class, 'tempurung'])->name('laporan.tempurung');
Route::get('/laporan/dkp_reject', [LaporanController::class, 'dkp_reject'])->name('laporan.dkp_reject');



Route::get('/rekap_laporan/tempurung', [RekapController::class, 'tempurung'])->name('rekap_laporan.pembukaan_tempurung');
Route::get('/rekap_laporan/kulit_ari', [RekapController::class, 'kulitari'])->name('rekap_laporan.pembukaan_kulit_ari');



Route::get('/card_stock/santan', [StockController::class, 'santan'])->name('card_stock.santan');
Route::get('/card_stock/dkp', [StockController::class, 'dkp'])->name('card_stock.dkp');
Route::get('/card_stock/dkp_reject_kering', [StockController::class, 'dkp_reject_kering'])->name('card_stock.dkp_reject_kering');
Route::get('/card_stock/dkp_reject_basah', [StockController::class, 'dkp_reject_basah'])->name('card_stock.dkp_reject_basah');
Route::get('/card_stock/minyak_kelapa', [StockController::class, 'minyak_kelapa'])->name('card_stock.minyak_kelapa');
Route::get('/card_stock/air_kelapa', [StockController::class, 'air_kelapa'])->name('card_stock.air_kelapa');
Route::get('/card_stock/kelapa_bulat', [StockController::class, 'kelapa_bulat'])->name('card_stock.kelapa_bulat');
Route::get('/card_stock/tempurung_basah', [StockController::class, 'tempurung_basah'])->name('card_stock.tempurung_basah');
Route::get('/card_stock/kulit_ari_basah', [StockController::class, 'kulit_ari_basah'])->name('card_stock.kulit_ari_basah');
Route::get('/card_stock/kulit_ari_kering', [StockController::class, 'kulit_ari_kering'])->name('card_stock.kulit_ari_kering');
Route::get('/card_stock/ampas_kering_putih', [StockController::class, 'ampas_kering_putih'])->name('card_stock.ampas_kering_putih');
Route::get('/card_stock/ampas_kering_yellow', [StockController::class, 'ampas_kering_yellow'])->name('card_stock.ampas_kering_yellow');




Route::get('/data_pegawai', [DatapegawaiController::class, 'data_pegawai'])->name('data_pegawai');
Route::get('/edit_data_pegawai', [DatapegawaiController::class, 'edit_data_pegawai'])->name('edit_data_pegawai');
Route::get('/tambah_data_pegawai', [DatapegawaiController::class, 'tambah_data_pegawai'])->name('tambah_data_pegawai');


Route::get('/produksi/santan', [ProduksiController::class, 'santan'])->name('produksi.santan');
Route::get('/produksi/air_kelapa', [ProduksiController::class, 'air_kelapa'])->name('produksi.air_kelapa');
require __DIR__.'/auth.php';
