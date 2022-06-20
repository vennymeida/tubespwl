@extends('layouts.app')
 
@section('content')
<div class="container mt-5">
    <div class="row justify-content-center align-items-center">
        <div class="card" style="width: 24rem;">
            <div class="card-header">
            Detail User
            </div>
        <div class="card-body">
            <ul class="list-group list-group-flush">
            <li class="list-group-item"><b>Name: </b>{{$User->name}}</li>
            <li class="list-group-item"><b>Email: </b>{{$User->email}}</li>
            <li class="list-group-item"><b>Alamat: </b>{{$User->alamat}}</li>
            <li class="list-group-item"><b>Nohp: </b>{{$User->nohp}}</li>
            <li class="list-group-item"><b>Role: </b>{{$User->role}}</li>
            </ul>
        </div>
            <a class="btn btn-success mt-3" href="{{ route('user.index') }}">Kembali</a>
        </div>
    </div>
</div>
@endsection