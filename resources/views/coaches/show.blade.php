@extends('layouts.app')
@section("page-title")
    Coach Details
@endsection
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
                                <img class="profile-user-img img-fluid img-circle" src="{{asset($coach->avatar)}}"
                                     alt="User profile picture">
                            </div>
                            <p class="profile-username text-center"><strong>Name: </strong>{{ $coach->name}}</p>
                            <p class="profile-username text-center"><strong>Email: </strong>{{ $coach->email }}</p>
                            <p class="profile-username text-center"><strong>Sessions
                                    Count: </strong>{{ $coach->sessions ? $coach->sessions->count() : 0 }}</p>

                            <div class="text-center p-4 align-items-center d-flex justify-content-center">
                                <a href="{{ route('coaches.edit', ['coach' => $coach->id]) }}" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Edit
                                    Info</a>
                            </div>
                        </div>
                        <!-- /.card-body -->
                    </div>
                    <!-- /.card -->

                </div>
                <!-- /.col -->
@endsection
