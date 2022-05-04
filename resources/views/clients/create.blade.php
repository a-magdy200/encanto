@extends('layouts.app')

        @section('content')
            <div class="card card-primary">

                <!-- /.card-header -->
                <!-- form start -->
                <form method="POST" action="{{ route('clients.store') }}" enctype="multipart/form-data">
                    @csrf
                    <div class="card-body">
                        <div class="form-group">
                            <label for="exampleInputEmail1">User Name</label>
                            <input type="text" name="name" class="form-control" id="exampleInputEmail1" placeholder="Enter name">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputEmail1">Email address</label>
                            <input type="email"  name="email" class="form-control" id="exampleInputEmail1" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">Password</label>
                            <input type="password"  name ="password" class="form-control" id="exampleInputPassword1" placeholder="Password">
                        </div>
                        <div class="form-group">
                            <label for="exampleInputPassword1">birth day</label>
                            <input type="date"  name ="date" class="form-control" id="exampleInputPassword1" placeholder="">
                        </div>

                        <div class="form-group">
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" value="male" id="customRadio1" name="gender">
                                <label for="customRadio1" class="custom-control-label">male</label>
                            </div>
                            <div class="custom-control custom-radio">
                                <input class="custom-control-input" type="radio" id="customRadio2"  value="female" name="gender" checked>
                                <label for="customRadio2" class="custom-control-label">female</label>
                            </div>

                        </div>
                        <div class="form-group">
                            <label for="exampleInputFile">image file</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"  name="avatar" class="form-control" id="exampleInputFile">

                                </div>

                            </div>
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
