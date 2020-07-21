@extends('layout')

@section('content')
<h1 align="center">List of Restaurants</h1>
@if(Session::get('Status'))

<div class="alert alert-success alert-dismissible fade show" role="alert">
    <strong>{{Session::get('Status')}}!</strong>
    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
        <span aria-hidden="true">&times;</span>
    </button>
</div>
@endif
<table class="table">
    <thead class="thead-dark">
        <tr>
            <th scope="col">#</th>
            <th scope="col">Name</th>
            <th scope="col">Email</th>
            <th scope="col">Address</th>
            <th scope="col"></th>
            <th scope="col"></th>
        </tr>
    </thead>
    <tbody>
        @foreach($data as $item)
        <tr>
            <th scope="row">{{$item->id}}</th>
            <td>{{$item->name}}</td>
            <td>{{$item->email}}</td>
            <td>{{$item->address}}</td>
            <td><a href="/delete/{{$item->id}}"><i class="fa fa-trash"></i></a></td>
            <td><a href="/edit/{{$item->id}}"><i class="fa fa-edit"></i></a></td>
        </tr>
        @endforeach
    </tbody>
</table>

<a class="btn btn-success" href="/add" role="button">Add Restaurant</a>
@endsection