@extends('pelanggan.layout')
 
@section('content')
 
<div class="container mt-5">
 
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Tambah Pelanggan
            </div>
        <div class="card-body">
 @if ($errors->any())
    <div class="alert alert-danger">
        <strong>Whoops!</strong> There were some problems with your input.<br><br>
        <ul>
        @foreach ($errors->all() as $error)
        <li>{{ $error }}</li>
        @endforeach
        </ul>
    </div>
 @endif
    <form method="post" action="{{ route('pelanggan.store') }}" enctype="multipart/form-data" id="myForm">
 @csrf
 <div class="form-group">
    <label for="Nik">Nik</label> 
        <input type="text" name="Nik" class="form-control" id="Nik" aria-describedby="Nik" > 
    </div>
    <div class="form-group">
        <label for="Nama">Nama</label> 
        <input type="Nama" name="Nama" class="form-control" id="Nama" aria-describedby="Nama" > 
    </div>
    <div class="form-group">
        <label for="Alamat">Alamat</label> 
        <input type="text" name="Alamat" class="form-control" id="Alamat" aria-describedby="Alamat" > 
    </div>
    <div class="form-group">
        <label for="Telepon">Telepon</label> 
        <input type="text" name="Telepon" class="form-control" id="Telepon" aria-describedby="Telepon" > 
    </div>
        <button type="submit" class="btn btn-primary">Submit</button>
         </form>
    </div>
    </div>
 </div>
 </div>
@endsection