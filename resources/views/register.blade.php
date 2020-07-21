@extends('layout')

@section('content')
<h1 align="center">Registration page</h1>
<div class="col-6">
    <form action="/register" method="post">
        <div class="form-group">
            <label for="exampleInputEmail1">Name</label>
            <input type="text" class="form-control" name="name">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Email</label>
            <input type="email" class="form-control" name="email">
            <small class="form-text text-muted">We'll never share your email with anyone else.</small>
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Password</label>
            <input type="password" class="form-control" name="password">
        </div>
        <div class="form-group">
            <label for="exampleInputEmail1">Mobile No.</label>
            <input type="text" class="form-control" name="mobile">
        </div>
        <button type="submit" class="btn btn-primary">Register</button>
        @csrf
    </form>
</div>
@endsection