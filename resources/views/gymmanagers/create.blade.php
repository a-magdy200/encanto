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
                    <li class="breadcrumb-item"><a href="{{route('/home')}}">Home</a></li>
                    <li class="breadcrumb-item active">City Manager</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
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
    <form method="post" action="{{route('gymmanagers.store')}}" enctype="multipart/form-data">
        {{ csrf_field() }}

        <div class="card-body">
            <div class="form-group">
                <label for="exampleInputName1">Name</label>
                <input name="name" value="" type="text" class="form-control" id="exampleInputName1" placeholder="Enter email">
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input name="email" value="" type="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                </div>
                <div class="form-group">
                    <label for="exampleInputPassword1">Password</label>
                    <input name="password" value="" type="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                </div>
                <div class="form-group">
                    <label for="exampleInputnational_id1">National ID</label>
                    <input name="national_id" value="" type="text" class="form-control" id="exampleInputnattionalid1" placeholder="Enter national id">
                </div>
                <div class="mb-3">
                    <label for="exampleFormControlTextarea1" class="form-label">Gym</label>
                    <select name="gym" name="user_id" class="form-control">
                        @foreach ($gyms as $gym)
                        <option value="{{$gym->id}}">{{$gym->name}}</option>
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
                <div class="form-check">
                    <input type="checkbox" class="form-check-input" id="exampleCheck1">
                    <label class="form-check-label" for="exampleCheck1">Check me out</label>
                </div>
            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
    </form>
    @endsection
