@extends('layouts.app')
@section('page-title')
    Edit Profile Information
@endsection
@section('content')
    <form method="post" action="{{ route('profile.update')}}">
        @method("PUT")
        @csrf
        <div class="form-group">
            <label for="name">User Name</label>
            <input id="name" type="text" class="form-control" name="userName" value="{{auth()->user()->name}}">
        </div>
        <div class="form-group">
            <label for="email">User Email</label>
            <input type="email" id="email" class="form-control" name="userEmail" value="{{auth()->user()->email}}">
        </div>

        @if(auth()->user()->hasAnyRole(['City Manger', 'Gym Managaer']))
            <div class="form-group">
                <label for="national_id"> National Id</label>
                <input id="national_id" type="text" class="form-control" name="national_id"
                       value="{{auth()->user()->manager->national_id}}">
            </div>
        @endif
        @if(auth()->user()->hasRole('Client'))
            <div class="form-group">
                <label for="dob">Date Of Birth </label>
                <input id="dob" type="date" class="form-control" name="dateofbirth"
                       value="{{auth()->user()->client->date_of_birth}}">
            </div>
        @endif
        <!--  <div class="form-group">
        <label>Gender </label>
        <input type="radio" value="male" name="gender">
        <input type="radio" value="female" name="gender">

    </div>
-->
        <button class="btn btn-success">Update</button>


    </form>
@endsection
