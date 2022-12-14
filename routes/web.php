<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HistoryController;
use App\Http\Controllers\UsersController;
use Illuminate\Http\Request;


/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});
Route::get('/home', [App\Http\Controllers\HomeController::class, 'index'])->name('main');
Auth::routes();

// <!-- ROUTE USER PELANGGAN -->
Route::get('/homepelanggan', [App\Http\Controllers\HomeController::class, 'indexbarang'])->name('homepelanggan');
Route::get('/pesan/{id}', [App\Http\Controllers\PesanController::class, 'index'])->name('pesan.index');
Route::post('/pesan/{id}', [App\Http\Controllers\PesanController::class, 'pesan'])->name('pesan.check_out');
Route::get('/check-out', [App\Http\Controllers\PesanController::class, 'check_out'])->name('pesan.check_out');
Route::delete('check-out/{id}', [App\Http\Controllers\PesanController::class, 'delete'])->name('pesan.check_out');

Route::get('/konfirmasi-check-out', [App\Http\Controllers\PesanController::class, 'konfirmasi'])->name('pesan.check_out');

Route::get('profile', [App\Http\Controllers\ProfileController::class, 'index'])->name('profile.index');
Route::post('profile', [App\Http\Controllers\ProfileController::class, 'update'])->name('profile.index');

Route::get('history', [App\Http\Controllers\HistoryController::class, 'index'])->name('history.index');
Route::get('history/{id}', [App\Http\Controllers\HistoryController::class, 'detail'])->name('history.detail');
Route::get('history/{id}/history_pdf', [App\Http\Controllers\HistoryController::class, 'history_pdf'])->name('history.history_pdf');


// <!-- ROUTE USER ADMIN -->
Route::resource('pelanggan', PelangganController::class);
Route::resource('barang', BarangController::class);
Route::get('barang_pdf', [App\Http\Controllers\BarangController::class, 'barang_pdf'])->name('barang.barang_pdf');
Route::resource('user', UsersController::class);
Route::get('riwayat_transaksi', [App\Http\Controllers\HistoryController::class, 'riwayat_transaksi'])->name('riwayat_transaksi.riwayat_transaksi');