@extends('layouts.app')
@section('content')

<h1 class="text-center">Add City</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <div class="card-header">
          </div>
          <!-- /.card-header -->
          <div class="card-body">
            <!-- form start -->
            <form method="POST" action="{{ route('create.city') }}">
                @csrf
                <div class="form-group">
                  <label for="cityName">City</label>
                  <input type="text" id="cityName" class="form-control" name="cityName" placeholder="Enter ...">
                </div>
                <div class="form-group">
                    <label for="cityManager">City Manager</label>
                    <input type="text" id="cityManager" class="form-control" name="cityManager" placeholder="Enter ...">
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
