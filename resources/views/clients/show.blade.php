@extends('layouts.app')
@section("page-title")
    Client Information
@endsection
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=>Client</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Client</li>
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
                                <img class="profile-user-img img-fluid img-circle"
                                     src="{{Storage::url($client->user->avatar)}}"
                                     alt="User profile picture">
                            </div>
                            <p class="profile-username text-center"><strong>Name: </strong>{{ $client->user->name}}</p>
                            <p class="profile-username text-center"><strong>Email: </strong>{{ $client->user->email }}
                            </p>
                            <p class="profile-username text-center"><strong>Gender: </strong>{{ $client->gender }}</p>
                            <p class="profile-username text-center">
                                <strong>Birthdate: </strong>{{ $client->date_of_birth }}</p>
                            <p class="profile-username text-center"><strong>Sessions
                                    Count: </strong>{{ $client->sessions ? $client->totalSssionsCount() : 0 }}</p>
                            <p class="profile-username text-center"><strong>Attended
                                    Sessions: </strong>{{ $client->attendance ? $client->attendance->count() : 0 }}</p>
                            <p class="profile-username text-center"><strong>Remaining
                                    Sessions: </strong>{{ $client->sessions ? $client->remainingSessionsCount() : 0 }}
                            </p>
                            <div class="text-center p-4 align-items-center d-flex justify-content-center">
                                <a href="{{ route('clients.edit', ['client' => $client->id]) }}"
                                   class="btn btn-success"><i class="fa fa-edit mr-1"></i>Edit
                                    Info</a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
@endsection
