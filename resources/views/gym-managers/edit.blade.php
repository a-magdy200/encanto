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
<form method="post" action="{{route('gym-managers.update',['gymManager'=>$gymManager])}}" enctype="multipart/form-data">
  @method('put')
  @csrf

  <div class="mb-3">
    <label for="exampleFormControlInput1" class="form-label">Name</label>
    <input name="name" type="text" class="form-control" id="exampleFormControlInput1" value="{{$gymManager->user->name}}">
  </div>
  <div class="mb-3">
    <label for="exampleFormControlEmail" class="form-label">Email</label>
    <input type="email" name='email' class="form-control" id="exampleFormControlEmail" value="{{$gymManager->user->email}}" />
  </div>

  <div class="mb-3">
    <label for="exampleFormControlTextarea1" class="form-label">Gym</label>
    <select name="gym" class="form-control">
      @foreach ($gyms as $gym)
      <option value="{{$gym->id}}" @checked($gymManager->gym && ($gymManager->gym->id ==$gym->id)) name="gym">{{$gym->name}}</option>
      @endforeach
    </select>
  </div>
  <div class="form-group">
    <label for="exampleInputEmail1">Update Image</label>
    <input type="file" id="image" name="image" class="@error('image') is-invalid @enderror form-control">
    @error('image')
    <div class="alert alert-danger mt-1 mb-1">{{ $message }}
    </div>
    @enderror
  </div>
  <div class="mb-3">
    <button type="submit" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Edit</button>
  </div>
</form>
@endsection
