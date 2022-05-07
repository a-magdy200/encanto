@extends('layouts.app')
@section("page-title")
    Edit City Manager Information
@endsection
@section('content')
    <div class="card card-primary mt-4">
        <div class="card-header">
            <h3 class="card-title">Update City Manager Information</h3>
        </div>
        <!-- /.card-header -->

        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('city-managers.update', ['cityManager' => $cityManager]) }}"
              enctype="multipart/form-data">
            @csrf
            @method('PUT')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputName1">Name</label>
                    <input type="text" Name="name" class="form-control @error('name') is-invalid @enderror"
                           id="exampleInputName1" value="{{ $cityManager->user->name }}">
                </div>
                @error('name')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" class="form-control @error('email') is-invalid @enderror"
                           id="exampleInputEmail1" name="email" value="{{ $cityManager->user->email }}">
                </div>
                @error('email')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <div class="form-group">
                    <label for="city-select" class="form-label">City</label>
                    <select id="city-select" class="form-control @error('city') is-invalid @enderror" name='city'>
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
                    <input type="file" id="avatar" name="avatar"
                           class="form-control  @error('avatar') is-invalid @enderror">
                </div>
                @error('avatar')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
                <!-- /.card-body -->
                <div class="card-footer" style="margin-top: -15px">
                    <button type="submit" class="btn btn-primary">Submit</button>
                </div>
            </div>
        </form>
    </div>
    <!-- /.card -->
@endsection
