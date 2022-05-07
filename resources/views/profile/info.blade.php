@extends('layouts.app')
@section('page-title')
    Profile
@endsection
@section('content')
    <div class="text-center p-4 align-items-center d-flex justify-content-center">
        <a href="{{ route('profile.edit') }}" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Edit Info</a>
        <a href="{{ route('profile.edit-pass') }}" class="ml-4 btn btn-success"><i class="fa fa-edit mr-1"></i>Edit Password</a>
    </div>
    <div class="card card-primary card-outline">
        <div class="card-body box-profile">
            <div class="text-center">
                <img class="profile-user-img img-fluid img-circle" style="width:100px;height:100px;"
                     src="{{Storage::url(auth()->user()->avatar)}}" alt="User profile picture">
            </div>

            <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

            <p class="text-muted text-center">{{auth()->user()->getRoleNames()}}
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Email</b> <a class="float-right">{{auth()->user()->email}}</a>
                </li>
                @if(auth()->user()->hasAnyRole(['City Manager', 'Gym Manager']))
                    <li class="list-group-item">
                        <b>National Id</b> <a class="float-right">{{auth()->user()->manager->national_id}}</a>
                    </li>
                    @if(auth()->user()->hasRole('City Manager'))
                        <li class="list-group-item">
                            <b>City</b> <a
                                class="float-right">{{auth()->user()->manager->city ?auth()->user()->manager->city->name : "Not Assigned"}}</a>
                        </li>
                    @else
                        <li class="list-group-item">
                            <b>Gym Name</b> <a
                                class="float-right">{{auth()->user()->manager->gym ? auth()->user()->manager->gym->name : "Not Assigned"}}</a>
                        </li>
                    @endif
                @endif
                @if(auth()->user()->hasRole('Client'))
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
