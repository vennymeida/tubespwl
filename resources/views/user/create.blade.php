@extends('layouts.app')
 
@section('content')
 
<div class="container mt-5">
 
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Tambah User
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
    <form method="post" action="{{ route('user.store') }}" enctype="multipart/form-data" id="myForm">
 @csrf
 <div class="form-group">
    <label for="Name">Name</label> 
        <input type="text" name="Name" class="form-control" id="Name" aria-describedby="Name" > 
    </div>
    <div class="form-group">
        <label for="Email">Email</label> 
        <input type="Email" name="Email" class="form-control" id="Email" aria-describedby="Email" > 
    </div>
    <div class="form-group">
        <label for="Alamat">Alamat</label> 
        <input type="text" name="Alamat" class="form-control" id="Alamat" aria-describedby="Alamat" > 
    </div>
    <div class="form-group">
        <label for="Nohp">Nohp</label> 
        <input type="text" name="Nohp" class="form-control" id="Nohp" aria-describedby="Nohp" > 
    </div>
    <div class="form-group">
        <label for="Role">Role</label> 
        <input type="text" name="Role" class="form-control" id="Role" aria-describedby="Role" > 
    </div>
        <button type="submit" class="btn btn-primary">Submit</button>
         </form>
    </div>
    </div>
 </div>
 </div>
@endsection