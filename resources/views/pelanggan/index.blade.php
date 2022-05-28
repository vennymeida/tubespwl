@extends('pelanggan.layout')

@section('content')
 <div class="row">
    <div class="col-lg-12 margin-tb">
        <div class="pull-left mt-2">
            <h2>DAFTAR PELANGGAN 2ND MOBIL BEKAS MALANG</h2>
        </div>
        <div class="float-right my-2">
        </div>
        <div class="float-left my-3">
                <form action="{{ route('pelanggan.index') }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" name="search" value="{{ request('search')}}" style="width: 1000px">
                        <button class="btn btn-primary" type="submit">Search</button>&emsp;
                        <a class="btn btn-success" href="{{ route('pelanggan.create') }}"> Input Pelanggan</a>
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
        <th>Nik</th>
        <th>Nama</th>
        <th>Alamat</th>
        <th>Telepon</th>
        <th width="280px">Action</th>
 </tr>
 @foreach ($paginate as $pln)
 <tr>
        <td>{{ $pln ->nik }}</td>
        <td>{{ $pln ->nama }}</td>
        <td>{{ $pln ->alamat }}</td>
        <td>{{ $pln ->telepon }}</td>
        <td>
    <form action="{{ route('pelanggan.destroy',['pelanggan'=>$pln->nik]) }}" method="POST">
 
        <a class="btn btn-info" href="{{ route('pelanggan.show',$pln->nik) }}">Show</a>
        <a class="btn btn-primary" href="{{ route('pelanggan.edit',$pln->nik) }}">Edit</a>
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