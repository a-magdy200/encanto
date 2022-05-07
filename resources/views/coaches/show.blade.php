@extends('layouts.app')
@section("page-title")
    Coach Details
@endsection
        @section('content')
            <div class="row justify-content-center mt-5">
                <div class="col-md-6">

                    <!-- Profile Image -->
                    <div class="card card-primary card-outline ">
                        <div class="card-body box-profile">
                            <div class="text-center">
                                <img class="profile-user-img img-fluid img-circle" src="{{Storage::url($coach->avatar)}}"
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
