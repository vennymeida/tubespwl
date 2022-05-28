@extends('pelanggan.layout')
 
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Detail Pelanggan
            </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Nik: </b>{{$Pelanggan->nik}}</li>
            <li class="list-group-item"><b>Nama: </b>{{$Pelanggan->nama}}</li>
            <li class="list-group-item"><b>Alamat: </b>{{$Pelanggan->alamat}}</li>
            <li class="list-group-item"><b>Telepon: </b>{{$Pelanggan->telepon}}</li>
            </ul>
        </div>
            <a class="btn btn-success mt-3" href="{{ route('pelanggan.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection