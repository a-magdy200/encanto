@extends('layouts.app')
@section("page-title")
    Gym Details
@endsection
@section('content')
    <h1 class="text-center mb-4">Show Gym Data</h1>
    <!-- Profile Image -->
    <div class="card card-primary card-outline">
        <div class="card-body box-profile ">
            <div class="text-center">

                <img class="profile-user-img img-fluid img-circle"
                     src="{{ asset($gym['cover_image']) }}"
                     alt="Gym Cover Image">
            </div>

            <h3 class="profile-username text-center">{{ $gym['name'] }}</h3>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>Gym Managers</b> <a class="float-right">{{$gym->managers->count()}}</a>
                </li>
                <li class="list-group-item">
                    <b>Training Session</b> <a class="float-right">{{$gym->sessions->count()}}</a>
                </li>
                <li class="list-group-item">
                    <b>Coaches</b> <a class="float-right">{{$gym->coachesCount()}}</a>
                </li>
            </ul>
            <div class="d-flex align-items-center justify-content-center">

                <a href="{{ route('gyms.index') }}" class="btn btn-warning"><i class="fa fa-chevron-left mr-1"></i>Back</a>
                <a href="{{ route('gyms.edit', ['gym' =>  $gym]) }}" class="btn btn-success ml-1"><i class="fa fa-pen mr-1"></i>Edit</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
