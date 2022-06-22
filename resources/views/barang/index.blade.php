@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-5">
        <div class="pull-left mt-2">
            <h2>DAFTAR MOBIL 2ND MOBIL BEKAS MALANG</h2>
        </div>
        <div class="float-right my-2">
        </div>
        <div class="float-left my-3">
                <form action="{{ route('barang.index') }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" name="search" value="{{ request('search')}}" style="width: 1000px">
                        <button class="btn btn-primary" type="submit">Search</button>&emsp;
                        <a class="btn btn-success" href="{{ route('barang.create') }}"> Input Mobil</a>
                        <a class="btn btn-primary" href="{{ route('barang.barang_pdf') }}">Cetak Data Mobil</a>
                    </div>
            </div>
        </div>
 
@if ($message = Session::get('success'))
    <div class="alert alert-success">
        <p>{{ $message }}</p>
    </div>
@endif
@if ($message = Session::get('error'))
    <div class="alert alert-error">
        <p>{{ $message }}</p>
    </div>
@endif
 
 <table class="table table-bordered">
 <tr>
        <th>Merk</th>
        <th>Harga</th>
        <th>Stok</th>
        <th>Keterangan</th>
        <th>Foto</th>
        <th width="280px">Action</th>
 </tr>
 @foreach ($paginate as $pln)
 <tr>
        <td>{{ $pln ->merk }}</td>
        <td>{{ $pln ->harga }}</td>
        <td>{{ $pln ->stok }}</td>
        <td>{{ $pln ->keterangan }}</td>
        <td><img width="100px" height="100px" src="{{asset('storage/'.$pln->featured_image)}}"></td>
        <td>
    <form action="{{ route('barang.destroy',['barang'=>$pln->merk]) }}" method="POST">
 
        <a class="btn btn-info" href="{{ route('barang.show',$pln->merk) }}">Show</a>
        <a class="btn btn-primary" href="{{ route('barang.edit',$pln->merk) }}">Edit</a>
        @csrf
        @method('DELETE')
    <button type="submit" class="btn btn-danger">Delete</button>
    </form>
    </td>
 </tr>
 @endforeach
 </table>
 {{ $paginate->links()}}
@endsection