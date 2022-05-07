@extends('layouts.app')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=>Profile</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">City Manager</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    @endsection
    @section('content')
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">

                <!-- Profile Image -->
                <div class="card card-primary card-outline ">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{asset('storage/images' .$user->avatar)}}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $user->name}}</h3>

                        <p class="text-muted text-center">{{ $user->email }}</p>

                        <div class="list-group list-group-unbordered mb-3">
                            <strong><i class="fas fa-id-card"></i> National Id</strong>

                            <p class="text-muted">
                                {{ $user->manager->national_id }}
                            </p>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">{{ $user->manager->city ? $user->manager->city->name : 'no city'}}</p>

                        </div>
                        <div class="row justify-content-center">
                            <div class="col-3">
                                <a href="{{ route('citymanagers.index') }}" class="btn btn-primary btn-block"><i class="fa fa-chevron-left mr-1"></i>Back</a>

                            </div>

                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        @endsection
