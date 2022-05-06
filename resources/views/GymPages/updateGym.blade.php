@extends('layouts.app')
@section('content')

<h1 class="text-center">Update Gym</h1>

<div class="row">
  <div class="col-12">
    <div class="card">
      <!-- /.card-header -->
      <div class="card-body">
        <!-- form start -->

        <form method="POST" action="{{ route('update.gymForm',['gymId'=>$Gym['id']]) }}" enctype="multipart/form-data">
          @csrf
          @method('put')
          <div class="form-group">
            <label for="gymName">Gym Name</label>
            <input type="text" id="gymName" class="form-control @error('gymName') is-invalid @enderror" name="gymName" value="{{ $Gym['name'] }}" placeholder="Enter ...">
            @error('gymName')
            <br>
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <label>Gym Cover Image</label>
            <div class="input-group">
              <div class="custom-file">
                <img style="width:100px;height:100px;" src="{{ asset($Gym['cover_image']) }}" alt="Gym cover image" title="Gym cover image">
                <input type="file" class="custom-file-input @error('gymCoverImg') is-invalid @enderror" name="gymCoverImg" id="exampleInputFile1">
                <label class="custom-file-label" for="exampleInputFile1">Choose file</label>

              </div>
            </div>
            @error('gymCoverImg')
            <br>
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>

          <div class="form-group">
            <label>City Name</label>
            <select class="form-control @error('gym_city') is-invalid @enderror" style="width: 100%;" name="gym_city">

              @foreach ($cities as $city)
              <option @if($Gym->city->id == $city->id) selected @endif value="{{ $city['id'] }}">{{ $city['name'] }}</option>
              @endforeach
            </select>
            @error('gym_city')
            <br>
            <div class="alert alert-danger">{{ $message }}</div>
            @enderror
          </div>
          <div class="form-group">
            <button type="submit" class="btn btn-primary form-control">Update</button>
          </div>
        </form>
      </div>
    </div>
  </div>

  @endsection