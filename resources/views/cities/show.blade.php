@extends('layouts.app')
@section("page-title")
    City Details
@endsection
@section('content')
    <h1 class="text-center mb-4">Show City Data</h1>
    <div class="card card-primary card-outline">
        <div class="card-body box-profile ">
            <h3 class="profile-username text-center">{{ $city['name'] }}</h3>
            <ul class="list-group list-group-unbordered mb-3">
                <li class="list-group-item">
                    <b>City Manager</b> <a
                        class="float-right">{{$city->manager ? $city->manager->user->name : "Not Assigned"}}</a>
                </li>
                <li class="list-group-item">
                    <b>Gyms</b> <a class="float-right">{{$city->gyms->count()}}</a>
                </li>
                <li class="list-group-item">
                    <b>Coaches</b> <a class="float-right">{{$city->coachesCount()}}</a>
                </li>
            </ul>

            <div class="d-flex align-items-center justify-content-center">

                <a href="{{ route('cities.index') }}" class="btn btn-warning"><i class="fa fa-chevron-left mr-1"></i>Back</a>
                <a href="{{ route('cities.edit', ['city' => $city]) }}" class="btn btn-success ml-1"><i
                        class="fa fa-edit mr-1"></i>Edit</a>
            </div>
        </div>
        <!-- /.card-body -->
    </div>
    <!-- /.card -->
@endsection
