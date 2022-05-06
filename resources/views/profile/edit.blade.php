@extends('layouts.app')

@section('content')
<div class="text-center">
  <a href="{{ route('profile.editpass') }}" class="mt-4 btn btn-success">Edit Password </a>
</div><br>
<form method="post" action="{{ route('profile.update')}}">
    @method("PUT")
    @csrf
    <div class="form-group">
        <label>User Name</label>
        <input type="text" class="form-control" name="userName" value="{{auth()->user()->name}}">
    </div>
    <div class="form-group">
        <label>User Email</label>
        <input type="email" class="form-control" name="userEmail" value="{{auth()->user()->email}}">
    </div>
   
    @if(Auth::user()->role_id ==2)
    <div class="form-group">
        <label> National Id</label>
        <input type="text" class="form-control" name="nationalid" value="{{auth()->user()->manager->national_id}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1" class="form-label">City</label>
        <select class="form-control" name='cityid'>
            @foreach ($cities as $city)
            <option @if(Auth::user()->manager->city_id  == $gym->id) selected @endif  value="{{ $city->id }}">{{ $city->name }}</option>
            @endforeach
        </select>
    </div>
    @elseif(Auth::user()->role_id ==3)
    <div class="form-group">
        <label> National Id</label>
        <input type="text" class="form-control" name="nationalid" value="{{auth()->user()->manager->national_id}}">
    </div>
    <div class="form-group">
        <label for="exampleFormControlTextarea1" class="form-label">City</label>
        <select class="form-control" name='gymid'>
            @foreach ($gyms as $gym)
            <option @if(Auth::user()->gymmanager->gym_id  == $gym->id) selected @endif  value="{{ $gym->id }}">{{ $gym->name }}</option>
            @endforeach
        </select>
    </div>
    @else(Auth::user()->role_id ==5)

    <div class="form-group">
        <label>Date Of Birth </label>
        <input type="date" class="form-control" name="dateofbirth" value="{{auth()->user()->client->date_of_birth}}">
    </div>
    <!--  <div class="form-group">
        <label>Gender </label>
        <input type="radio" value="male" name="gender">
        <input type="radio" value="female" name="gender">

    </div>
-->
    @endif
    <button class="btn btn-success">Update</button>


</form>
@endsection
