@extends('layouts.app')
@section('content-header')
<!-- Content Header (Page header) -->
<div class="row justify-content-center">
    <div class="col-6">
        <section class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1>City Manager Information</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Add City Manager</li>
                        </ol>
                    </div>
                </div>
            </div><!-- /.container-fluid -->
            @endsection
            @section('content')


            <div class="card card-primary mt-4">
                <div class="card-header">
                    <h3 class="card-title"></h3>
                </div>
                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('city-managers.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">Name</label>
                            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1" value="{{old('name')}}">
                        </div>
                        @error('name')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email" class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1" name="email" value="{{old('email')}}">
                        </div>
                        @error('email')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputEmail1">National Id</label>
                            <input type="text" class="form-control @error('national_id') is-invalid @enderror" id="exampleInputEmail1" name="national_id" value="{{old('national_id')}}">
                        </div>
                        @error('national_id')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password" class="form-control  @error('password') is-invalid @enderror" id="exampleInputPassword1" name="password">
                        </div>
                        @error('password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="exampleInputPassword1">Confirm Password</label>
                            <input type="password" class="form-control @error('new_password') is-invalid @enderror" id="exampleInputPassword1" name="confirm_password">
                        </div>
                        @error('confirm_password')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                        <div class="form-group">
                            <label for="exampleFormControlTextarea1" class="form-label">City</label>
                            <select class="form-control @error('city') is-invalid @enderror" name='city'>
                                @foreach ($cities as $city)
                                <option value="{{ $city->id }}">{{ $city->name }}</option>
                                @endforeach
                            </select>
                        </div>
                        @error('city')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror

                        <div class="form-group">
                            <label for="exampleInputFile">Avatar</label>
                            <input type="file" id="avatar" name="avatar" class="form-control  @error('avatar') is-invalid @enderror">
                        </div>
                        @error('avatar')
                        <div class="alert alert-danger">{{ $message }}</div>
                        @enderror
                    </div>

                    <!-- /.card-body -->
                    <div class="card-footer" style="margin-top: -15px">
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </div>
                </form>
            </div>
    </div>
</div>
<!-- /.card -->
@endsection
