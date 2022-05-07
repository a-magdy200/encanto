@extends('layouts.app')
@section('page-title')
    Gym Manager Information
@endsection
    @section('content')
        <div class="row justify-content-center">
            <div class="col-md-6">

                <!-- Profile Image -->
                <div class="card card-primary card-outline ">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{Storage::url($gymManager->user->avatar)}}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{$gymManager->user->name}}</h3>

                        <p class="text-muted text-center">{{$gymManager->user->email}}</p>

                        <div class="list-group list-group-unbordered mb-3">
                            <strong><i class="fas fa-id-card"></i> {{$gymManager->national_id}}</strong>

                            <p class="text-muted">
                                Gym Name:{{$gymManager->gym->name}}
                            </p>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">{{$gymManager->gym->city ? $gymManager->gym->city->name : "Not Assigned"}}</p>

                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                                <a href="{{route('gym-managers.index')}}" class="btn btn-warning"><i class="fa fa-chevron-left mr-1"></i>Back</a>
                                <a href="{{route('gym-managers.edit', ['gymManager' => $gymManager])}}" class="btn btn-success ml-1"><i class="fa fa-edit mr-1"></i>Edit</a>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        @endsection
