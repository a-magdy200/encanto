@extends('layouts.app')
@section("page-title")
    Edit Client Information
@endsection
@section('content')
    <div class="card card-primary">

        <!-- /.card-header -->
        <!-- form start -->
        <form method="POST" action="{{ route('clients.update',['client'=>$client->id]) }}"
              enctype="multipart/form-data">
            @csrf
            @method('put')
            <div class="card-body">
                <div class="form-group">
                    <label for="exampleInputEmail1">Name</label>
                    <input type="text" value="{{$client->user->name}}" name="name"
                           class="form-control @error('name') is-invalid @enderror" id="exampleInputEmail1"
                           placeholder="Enter email">
                    @error('name')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputEmail1">Email address</label>
                    <input type="email" value="{{$client->user->email}}" name="email"
                           class="form-control @error('email') is-invalid @enderror" id="exampleInputEmail1"
                           placeholder="Enter email">
                    @error('email')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                {{--                <div class="form-group">--}}
                {{--                    <label for="exampleInputPassword1">Password</label>--}}
                {{--                    <input type="password"  name ="password" class="form-control @error('password') is-invalid @enderror" id="exampleInputPassword1" placeholder="Password">--}}
                {{--                    @error('password')--}}
                {{--                    <div class="alert alert-danger">{{ $message }}</div>--}}
                {{--                    @enderror--}}
                {{--                </div>--}}
                <div class="form-group">
                    <label for="exampleInputPassword1">Birthdate</label>
                    <input value="{{$client->date_of_birth}}" type="date" name="date"
                           class="form-control @error('date') is-invalid @enderror" id="exampleInputPassword1"
                           placeholder="">
                    @error('date')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

                <div class="form-group">
                    <div class="custom-control custom-radio">
                        <input
                            @checked($client->gender == "male") class="custom-control-input @error('gender') is-invalid @enderror"
                            type="radio" value="male" id="customRadio1" name="gender">
                        <label for="customRadio1" class="custom-control-label "><i
                                class="fa fa-male mr-1"></i>Male</label>
                    </div>
                    <div class="custom-control custom-radio">
                        <input
                            @checked($client->gender == "female") class="custom-control-input @error('gender') is-invalid @enderror"
                            type="radio" id="customRadio2" value="female" name="gender">
                        <label for="customRadio2" class="custom-control-label "><i class="fa fa-female mr-1"></i>
                            Female</label>
                    </div>
                    @error('gender')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>
                <div class="form-group">
                    <label for="exampleInputFile">image file</label>
                    <div class="input-group">
                        <div class="custom-file">
                            <input type="file" name="avatar"
                                   class="custom-file-input @error('avatar') is-invalid @enderror"
                                   id="exampleInputFile">
                            <label class="custom-file-label" for="exampleInputFile">Choose file</label>
                        </div>
                        <div class="input-group-append">
                            <span class="input-group-text">Upload</span>
                        </div>
                    </div>
                    @error('avatar')
                    <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                </div>

            </div>
            <!-- /.card-body -->

            <div class="card-footer">
                <button type="submit" class="btn btn-primary">Submit</button>
            </div>
        </form>
    </div>
    <!-- /.card -->

@endsection

