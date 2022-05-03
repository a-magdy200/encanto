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
                  <input type="text" id="gymName" class="form-control" name="gymName" value="{{ $Gym['name'] }}" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <label>Gym Cover Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <label class="custom-file-label" for="exampleInputFile1">Choose file</label>
                      <input type="file" class="custom-file-input" name="gymCoverImg" id="exampleInputFile1">
                      <img style="width:100px;height:100px;" src="{{ asset('storage/GymImages/'.$Gym['cover_image']) }}" alt="Gym cover image" title="Gym cover image">
                    </div>
                  </div>
                </div>
              <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Update</button>
              </div>
            </form>
          </div>
        </div>
    </div>

@endsection
