@extends('layouts.app')
@section("page-title")
    City Manager Information
@endsection
    @section('content')
        <div class="row justify-content-center mt-5">
            <div class="col-md-6">

                <!-- Profile Image -->
                <div class="card card-primary card-outline ">
                    <div class="card-body box-profile">
                        <div class="text-center">
                            <img class="profile-user-img img-fluid img-circle" src="{{Storage::url($cityManager->user->avatar)}}"
                                alt="User profile picture">
                        </div>

                        <h3 class="profile-username text-center">{{ $cityManager->user->name}}</h3>

                        <p class="text-muted text-center">{{ $cityManager->user->email }}</p>

                        <div class="list-group list-group-unbordered mb-3">
                            <strong><i class="fas fa-id-card"></i> National Id</strong>

                            <p class="text-muted">
                                {{ $cityManager->national_id }}
                            </p>

                            <strong><i class="fas fa-map-marker-alt mr-1"></i> City</strong>

                            <p class="text-muted">{{ $cityManager->city ? $cityManager->city->name : 'Not Assigned'}}</p>

                        </div>
                        <div class="d-flex align-items-center justify-content-center">
                                <a href="{{ route('city-managers.index') }}" class="btn btn-warning"><i class="fa fa-chevron-left mr-1"></i>Back</a>
                                <a href="{{ route('city-managers.edit', ['cityManager' => $cityManager]) }}" class="btn btn-success ml-1"><i class="fa fa-edit"></i>Edit</a>
                        </div>

                    </div>
                    <!-- /.card-body -->
                </div>
                <!-- /.card -->

            </div>
            <!-- /.col -->
        @endsection
