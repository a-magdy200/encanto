@extends('layouts.app')

@section('content')
<div class="text-center">
  <a href="{{ route('profile.edit') }}" class="mt-4 btn btn-success">Edit </a>
</div><br>
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" style="width:100px;height:100px;" src="" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

        <p class="text-muted text-center">{{auth()->user()->role->name}}
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{auth()->user()->email}}</a>
            </li>
            @if(Auth::user()->role_id ==2)
            <li class="list-group-item">
                <b>National Id</b> <a class="float-right">{{auth()->user()->manager->national_id}}</a>
            </li>
            <li class="list-group-item">
                <b>City</b> <a class="float-right">{{auth()->user()->manager->city->name}}</a>
            </li>
            @elseif(Auth::user()->role_id ==3)
            <li class="list-group-item">
                <b>National Id</b> <a class="float-right">{{auth()->user()->gymManager->national_id}}</a>
            </li>
            <li class="list-group-item">
                <b>Gym Name</b> <a class="float-right">{{auth()->user()->gymManager->gym->name}}</a>
            </li>
            @else(Auth::user()->role_id ==5)
            <li class="list-group-item">
                <b>Date Of Birth</b> <a class="float-right">{{auth()->user()->client->date_of_birth}}</a>
            </li>
            <li class="list-group-item">
                <b>Gender</b> <a class="float-right">{{auth()->user()->client->gender}}</a>
            </li>
            @endif
        </ul>


    </div>
    <!-- /.card-body -->
</div>

@endsection
