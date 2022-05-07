@extends('layouts.app')
@section('content')

    <h1 class="text-center">Add Gym</h1>

    <div class="row">
        <div class="col-12">
            <div class="card">
                <div class="card-header">
                    <h3 class="card-title">Alex Gyms</h3>
                </div>
                <!-- /.card-header -->
                <div class="card-body">
                    <!-- form start -->
                    <form method="POST" action="{{ route('gyms.store') }}" enctype="multipart/form-data">
                        @csrf

                        <div class="form-group">
                            <label for="gymName">Gym Name</label>
                            <input value="{{old("gymName")}}" type="text" id="gymName"
                                   class="form-control @error('gymName') is-invalid @enderror" name="gymName"
                                   placeholder="Enter ...">
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

                        <div class="form-group">
                            <label for="city-select">City</label>
                            <select id="city-select" class="form-control @error('gym_city') is-invalid @enderror"
                                    style="width: 100%;" name="gym_city">
                                <option value="" disabled selected>Select city</option>
                                @foreach ($cities as $city)
                                    <option @checked(old("gym_city") == $city->id) value="{{ $city['id'] }}"
                                            class="form-control ">{{ $city['name'] }}</option>
                                @endforeach
                            </select>
                            @error('gym_city')
                            <br>
                            <div class="alert alert-danger">{{ $message }}</div>
                            @enderror
                        </div>
                        <div class="form-group">
                            <button type="submit" class="btn btn-primary form-control">Add</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

@endsection
