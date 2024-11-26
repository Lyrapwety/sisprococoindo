<?php

use App\Http\Controllers\DatapegawaiController;
use App\Http\Controllers\ProfileController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\LaporanController;
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

Route::get('/laporan/dkp', [LaporanController::class, 'dkp'])->name('laporan.dkp');
Route::get('/laporan/kulitari', [LaporanController::class, 'kulitari'])->name('laporan.kulitari');
Route::get('/laporan/airkelapa', [LaporanController::class, 'airkelapa'])->name('laporan.airkelapa');
Route::get('/laporan/serabutkelapa', [LaporanController::class, 'serabutkelapa'])->name('laporan.serabutkelapa');
Route::get('/laporan/tempurung', [LaporanController::class, 'tempurung'])->name('laporan.tempurung');
Route::get('/laporan/dkp_reject', [LaporanController::class, 'dkp_reject'])->name('laporan.dkp_reject');



Route::get('/rekap_laporan/dkp', [RekapController::class, 'dkp'])->name('rekap_laporan.dkp');
Route::get('/rekap_laporan/kulit_ari', [RekapController::class, 'kulitari'])->name('rekap_laporan.kulit_ari');
Route::get('/rekap_laporan/tempurung', [RekapController::class, 'tempurung'])->name('rekap_laporan.tempurung');
Route::get('/rekap_laporan/serabut_kelapa', [RekapController::class, 'serabut_kelapa'])->name('rekap_laporan.serabut_kelapa');
Route::get('/rekap_laporan/air_kelapa', [RekapController::class, 'air_kelapa'])->name('rekap_laporan.air_kelapa');


Route::get('/card_stock/santan', [StockController::class, 'santan'])->name('card_stock.santan');
Route::get('/card_stock/dkp', [StockController::class, 'dkp'])->name('card_stock.dkp');
Route::get('/card_stock/kopra_kering', [StockController::class, 'kopra_kering'])->name('card_stock.kopra_kering');
Route::get('/card_stock/kopra_basah', [StockController::class, 'kopra_basah'])->name('card_stock.kopra_basah');
Route::get('/card_stock/minyak_kelapa', [StockController::class, 'minyak_kelapa'])->name('card_stock.minyak_kelapa');
Route::get('/card_stock/air_kelapa', [StockController::class, 'air_kelapa'])->name('card_stock.air_kelapa');
Route::get('/card_stock/kelapa_bulat', [StockController::class, 'kelapa_bulat'])->name('card_stock.kelapa_bulat');
Route::get('/card_stock/tempurung_basah', [StockController::class, 'tempurung_basah'])->name('card_stock.tempurung_basah');
Route::get('/card_stock/kulit_ari_kering', [StockController::class, 'kulit_ari_kering'])->name('card_stock.kulit_ari_kering');



Route::get('/data_pegawai', [DatapegawaiController::class, 'data_pegawai'])->name('data_pegawai');
Route::get('/edit_data_pegawai', [DatapegawaiController::class, 'edit_data_pegawai'])->name('edit_data_pegawai');
Route::get('/tambah_data_pegawai', [DatapegawaiController::class, 'tambah_data_pegawai'])->name('tambah_data_pegawai');


Route::get('/produksi/santan', [ProduksiController::class, 'santan'])->name('produksi.santan');
Route::get('/produksi/air_kelapa', [ProduksiController::class, 'air_kelapa'])->name('produksi.air_kelapa');
require __DIR__.'/auth.php';
