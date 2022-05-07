@extends('layouts.app')
@section("page-title")
    Add City
@endsection
@section('content')

    <h1 class="text-center"><i class="fa fa-plus mr-1"></i>Add City</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->
                    <form method="POST" action="{{ route('cities.store') }}">
                        @csrf
                        <div class="form-group">
                            <label for="cityName">City</label>
                            <input value="{{old("cityName")}}" type="text" id="cityName"
                                   class="form-control @error('cityName') is-invalid @enderror" name="cityName"
                                   placeholder="Enter City Name...">
                            @error('cityName')
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Add City</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>

@endsection
