@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-5">

        </div>
            @foreach($barangs as $barang)
            <div class="col-md-4">
                <div class="card">
                  <img height="290px" src="{{asset('storage/'.$barang->featured_image)}}" class="card-img-top" alt="...">
                  <div class="card-body">
                    <h5 class="card-title">{{ $barang->merk }}</h5>
                    <p class="card-text">
                        <strong>Harga :
                        </strong> Rp. {{ number_format ($barang->harga)}} <br>
                        <Strong>Stok :
                        </strong>{{ $barang->stok }} <br>
                        <hr>
                        <strong>Keterangan :</strong> <br>
                        {{$barang->keterangan}}
                    </p>
                    <a href="{{ url('pesan') }}/{{ $barang->id }}" class="btn btn-primary"><i class="fa fa-shopping-cart"></i> Pesan</a>
                  </div>
                </div>
                </div>
            @endforeach
    </div>
</div>
@endsection
