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
                        <li class="breadcrumb-item active">coach</li>
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
                                <img class="profile-user-img img-fluid img-circle" src="{{asset($client->user->avatar)}}"
                                     alt="User profile picture">
                            </div>

                            <p class="profile-username text-center"><strong>Name: </strong>{{ $client->user->name}}</p>

                            <p class="profile-username text-center"> <strong>Email: </strong>{{ $client->user->email }}</p>
                            <p class="profile-username text-center"> <strong>gender: </strong>{{ $client->gender }}</p>
                            <p class="profile-username text-center"> <strong>date of birth: </strong>{{ $client->date_of_birth }}</p>





                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
@endsection
