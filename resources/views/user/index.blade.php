@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-12 mb-5">
        <div class="pull-left mt-2">
            <h2>DAFTAR USER 2ND MOBIL BEKAS MALANG</h2>
        </div>
        <div class="float-right my-2">
        </div>
        <div class="float-left my-3">
                <form action="{{ route('user.index') }}">
                    <div class="input-group mb-3">
                        <input type="text" class="form-control" placeholder="" name="search" value="{{ request('search')}}" style="width: 1000px">
                        <button class="btn btn-primary" type="submit">Search</button>&emsp;
                        <a class="btn btn-success" href="{{ route('user.create') }}"> Input User</a>
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
        <th>ID</th>
        <th>Name</th>
        <th>Email</th>
        <th>Alamat</th>
        <th>Nohp</th>
        <th>Role</th>
        <th width="280px">Action</th>
 </tr>
 @foreach ($paginate as $pln)
 <tr>
        <td>{{ $pln ->id }}</td>
        <td>{{ $pln ->name }}</td>
        <td>{{ $pln ->email }}</td>
        <td>{{ $pln ->alamat }}</td>
        <td>{{ $pln ->nohp }}</td>
        <td>{{ $pln ->role }}</td>
        <td>
    <form action="{{ route('user.destroy',['user'=>$pln->id]) }}" method="POST">
 
        <a class="btn btn-info" href="{{ route('user.show',$pln->id) }}">Show</a>
        <a class="btn btn-primary" href="{{ route('user.edit',$pln->id) }}">Edit</a>
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