<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\PesanController;
use App\Http\Controllers\PelangganController;
use App\Http\Controllers\BarangController;
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

Route::get('/homepelanggan', [App\Http\Controllers\HomeController::class, 'indexbarang'])->name('homepelanggan');
Route::get('/pesan/{id}', [App\Http\Controllers\PesanController::class, 'index'])->name('pesan.index');
Route::post('/pesan/{id}', [App\Http\Controllers\PesanController::class, 'pesan'])->name('pesan.check_out');
//Route::get('/pesan/checkout', [App\Http\Controllers\PesanController::class, 'pesan'])->name('pesan.check_out');
Route::resource('pelanggan', PelangganController::class);
// Route::get('/homepelanggan', 'HomeController@index')->name('homepelanggan');
Route::resource('barang', BarangController::class);
// Route::middleware(['auth'])->group(function () {
    
//     Route::get('/dashboard', function () {
//         $posts = Post::with('user')->get();
//         return view('dashboard', ['posts' => $posts]);
//     })->name('dashboard');

//     Route::get('/post/create', [PostController::class, 'create'])->name('new-post');
//     Route::post('/post/store', [PostController::class, 'store'])->name('store'); 

// });