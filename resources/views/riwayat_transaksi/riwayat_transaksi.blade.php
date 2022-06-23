@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-5">
        <div class="pull-left mt-2">
            <h2>DAFTAR SELURUH RIWAYAT TRANSAKSI</h2>
        </div>
        <div class="float-right my-2">
        </div>
 
 <table class="table table-bordered">
 <tr>
        <th>ID Pelanggan</th>
        <th>Tanggal Transaksi</th>
        <th>Kode</th>
        <th>Total Transaksi</th>
 </tr>
 @foreach ($pesanans as $p)
 <tr>
        <td>{{ $p ->user_id}}</td>
        <td>{{ $p ->tanggal }}</td>
        <td>{{ $p ->kode }}</td>
        <td>{{ $p ->jumlah_harga }}</td>
 </tr>
 @endforeach
 </table>
@endsection