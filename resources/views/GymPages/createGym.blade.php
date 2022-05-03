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
            <form method="POST" action="{{ route('create.gymForm') }}" enctype="multipart/form-data">
                @csrf

                <div class="form-group">
                  <label for="gymName">Gym Name</label>
                  <input type="text" id="gymName" class="form-control" name="gymName" placeholder="Enter ...">
                </div>
                <div class="form-group">
                  <label>Gym Cover Image</label>
                  <div class="input-group">
                    <div class="custom-file">
                      <label class="custom-file-label" for="exampleInputFile1">Choose file</label>
                      <input type="file" class="custom-file-input" name="gymCoverImg" id="exampleInputFile1">
                    </div>
                  </div>
                </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Add</button>
              </div>
            </form>
          </div>
        </div>
    </div>

@endsection
