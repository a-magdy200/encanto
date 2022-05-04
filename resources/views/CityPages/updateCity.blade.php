@extends('layouts.app')
@section('content')

<h1 class="text-center">Update City</h1>

    <div class="row">
      <div class="col-12">
        <div class="card">
          <!-- /.card-header -->
          <div class="card-body">
            <!-- form start -->

            <form method="POST" action="{{ route('update.city',['cityId'=>$city['id']]) }}">
                @csrf
                @method('put')
                <div class="form-group">
                  <label for="cityName">City</label>
                  <input type="text" id="cityName" class="form-control" name="cityName" value="{{ $city['name'] }}" placeholder="Enter ...">
                </div>

              <div class="form-group">
                <button type="submit" class="btn btn-primary form-control">Update</button>
              </div>
            </form>
          </div>
        </div>
      </div>
    </div>

@endsection
