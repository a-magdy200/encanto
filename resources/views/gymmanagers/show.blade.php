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
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Gym Manager</li>
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
                            <img class="profile-user-img img-fluid img-circle" src="../../dist/img/user4-128x128.jpg"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{$user->name}}</h3>

                        <p class="text-muted text-center">{{$user->email}}</p>

                        <div class="list-group list-group-unbordered mb-3">
                            <strong><i class="fas fa-id-card"></i> {{$gymmanager->national_id}}</strong>

                            <p class="text-muted">
                                Gym Name:{{$gym->name}}
                            </p>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> Location</strong>

                            <p class="text-muted">Alexandria, Egypt</p>

                        </div>
                        <div class="row mb-2 ">
                            <div class="col-3">
                                <a href="/gymmanagers" class="btn btn-primary btn-block "><b>Back</b></a>
                            </div>
                        </div>
                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        @endsection