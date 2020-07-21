@extends('layout')

@section('content')
<h1 class="heading">Edit Student Details</h1>
<div class="col-6">
    <form action="/edit" method="post">
        <div class="form-group">
            <input type="hidden" name="id" value="{{$data->id}}">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name" value="{{$data->name}}">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" name="email" value="{{$data->email}}">
            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Address</label>
            <input type="text" class="form-control" name="address" value="{{$data->address}}">
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
        @csrf
    </form>
</div>
@endsection