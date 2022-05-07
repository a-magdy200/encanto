@extends('layouts.app')
@section("page-title")
    Add Gym Manager
@endsection
@section('content')
    @if($errors->any())
        <div class="alert alert-danger">
            <ul class="list-unstyled">
                @foreach($errors->all() as $error)
                    <li>{{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif
    <form method="post" action="{{route('gym-managers.store')}}" enctype="multipart/form-data">
        @csrf

        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input name="name" value="{{old('name')}}" type="text" class="form-control" id="exampleInputName1"
                       placeholder="Enter name">
            </div>
            <div class="form-group">
                <label for="exampleInputEmail1">Email address</label>
                <input name="email" value="{{old('email')}}" type="email" class="form-control" id="exampleInputEmail1"
                       placeholder="Enter email">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword1">Password</label>
                <input name="password" value="" type="password" class="form-control" id="exampleInputPassword1"
                       placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputPassword2">Confirm Password</label>
                <input name="password_confirmation" value="" type="password" class="form-control"
                       id="exampleInputPassword2" placeholder="Password">
            </div>
            <div class="form-group">
                <label for="exampleInputnational_id1">National ID</label>
                <input value="{{old('national_id')}}" name="national_id" value="" type="text" class="form-control"
                       id="exampleInputnattionalid1" placeholder="Enter national id">
            </div>
            <div class="form-group">
                <label for="exampleFormControlTextarea1" class="form-label">Gym</label>
                <select name="gym" class="form-control">
                    @foreach ($gyms as $gym)
                        <option @checked(old("gym") == $gym->id) value="{{$gym->id}}">{{$gym->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="form-group">
                <label for="exampleInputFile">Image</label>
                <div class="input-group">
                    <div class="custom-file">
                        <input name="image" type="file" class="custom-file-input" id="exampleInputFile">
                        <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                    </div>
                    <div class="input-group-append">
                        <span class="input-group-text">Upload</span>
                    </div>
                </div>
            </div>
        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">Submit</button>
        </div>
    </form>
@endsection
