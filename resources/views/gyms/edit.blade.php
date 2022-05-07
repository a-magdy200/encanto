@extends('layouts.app')
@section("page-title")
    Edit Gym Details
@endsection
@section('content')

    <h1 class="text-center mb-4">Update Gym</h1>
    <div class="d-flex justify-content-center mb-4">
        <img style="width:100px;height:100px;" src="{{ asset($gym['cover_image']) }}" alt="Gym cover image"
             title="Gym cover image">
    </div>
    <div class="row">
        <div class="col-12">
            <div class="card">
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->

                    <form method="POST" action="{{ route('gyms.update',['gym'=>$gym]) }}" enctype="multipart/form-data">
                        @csrf
                        @method('put')
                        <div class="form-group">
                            <label for="gymName">Gym Name</label>
                            <input type="text" id="gymName" class="form-control @error('gymName') is-invalid @enderror"
                                   name="gymName" value="{{ $gym['name'] }}" placeholder="Enter ...">
                            @error('gymName')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <label>Gym Cover Image</label>
                            <div class="input-group">
                                <div class="custom-file">
                                    <input type="file"
                                           class="custom-file-input @error('gymCoverImg') is-invalid @enderror"
                                           name="gymCoverImg" id="exampleInputFile1">
                                    <label class="custom-file-label" for="exampleInputFile1">Choose file</label>

                                </div>
                            </div>
                            @error('gymCoverImg')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        @if(auth()->user()->hasRole('Super Admin'))
                            <div class="form-group">
                                <label for="city-name">City Name</label>
                                <select id="city-name" class="form-control @error('gym_city') is-invalid @enderror"
                                        style="width: 100%;" name="gym_city">
                                    @foreach ($cities as $city)
                                        <option @if($gym->city && $gym->city->id == $city->id) selected
                                                @endif value="{{ $city['id'] }}">{{ $city['name'] }}</option>
                                    @endforeach
                                </select>
                                @error('gym_city')
                                <br>
                                <div class="alert alert-danger">{{ $message }}</div>
                                @enderror
                            </div>
                        @endif
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
