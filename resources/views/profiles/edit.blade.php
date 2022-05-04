@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('profiles.update',['id'=>$trainingSession->id])}}">
    @method("PUT")
    @csrf
    <div class="form-group">
        <label>User Name</label>
        <input type="text" class="form-control" name="userName"value="{{auth()->user()->name}}" >
    </div>
    <div class="form-group">
        <label>User Email</label>
        <input type="email" class="form-control" name="userEmail"value="{{auth()->user()->email}}" >
    </div>
    <div class="form-group">
        <label> Password</label>
        <input type="password" class="form-control" name="userPassword"value="{{auth()->user()->password}}" >
    </div>
    <div class="form-group">
        <label>Confirm Password</label>
        <input type="password" class="form-control" name="confirmPassword"value="{{auth()->user()->password}}" >
    </div>
    
</form>
@endsection