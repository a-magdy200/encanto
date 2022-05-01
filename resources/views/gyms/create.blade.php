@extends('layouts.app')

@section('title')Create @endsection

@section('content')
@if ($errors->any())
<div class="alert alert-danger">
  <ul>
    @foreach ($errors->all() as $error)
    <li>{{ $error }}</li>
    @endforeach
  </ul>
</div>
@endif
<form method="post" action="{{route('gyms.store')}}" enctype="multipart/form-data">
  @csrf
  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">name</label>
    <input name="name" type="text" class="form-control" id="exampleFormControlInput1">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">email</label>
    <textarea name='email' class="form-control" id="exampleFormControlTextarea1" rows="3"></textarea>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Upload Image</label>
    <input type="file" id="image" name="image" class="@error('image') is-invalid @enderror form-control">
    @error('image')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}
    </div>
    @enderror
  </div>

  <div class="mb-3">
    <button type="submit" class="btn btn-success">create user</button>
  </div>
</form>

@endsection