@extends('layouts.app')
 
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Detail Mobil
            </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Merk: </b>{{$Barang->merk}}</li>
            <li class="list-group-item"><b>Harga: </b>{{$Barang->harga}}</li>
            <li class="list-group-item"><b>Stok: </b>{{$Barang->stok}}</li>
            <li class="list-group-item"><b>Keterangan: </b>{{$Barang->keterangan}}</li>
            <li class="list-group-item"><b>Foto: </b><img style="width: 100%" src="{{ asset('./storage/'. $Barang->featured_image) }}" alt=""></li>
        </ul>
        </div>
            <a class="btn btn-success mt-3" href="{{ route('barang.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection