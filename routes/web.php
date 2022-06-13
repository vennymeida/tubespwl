<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\ProfileController;
use App\Http\Controllers\BarangController;
use App\Http\Controllers\HistoryController;
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

Route::get('/home', function () {
    return view('main');
});

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


// <!-- ROUTE USER ADMIN -->
Route::resource('pelanggan', PelangganController::class);
Route::resource('barang', BarangController::class);
// Route::middleware(['auth'])->group(function () {
// Route::get('check-out', 'PesanController@check_out');   
//     Route::get('/dashboard', function () {
//         $posts = Post::with('user')->get();
//         return view('dashboard', ['posts' => $posts]);
//     })->name('dashboard');

//     Route::get('/post/create', [PostController::class, 'create'])->name('new-post');
//     Route::post('/post/store', [PostController::class, 'store'])->name('store'); 

// });