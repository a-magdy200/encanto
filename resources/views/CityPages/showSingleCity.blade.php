@extends('layouts.app')
@section('content')
<h1 class="text-center">Show City Data</h1>
<div class="card card-primary card-outline w-50">
  <div class="card-body box-profile ">
    <h3 class="profile-username text-center">{{ $city['name'] }}</h3>
    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>City Managers</b> <a class="float-right">{{ $city['manager_id'] }}</a>
      </li>
      <li class="list-group-item">
        <b>Gyms</b> <a class="float-right">20</a>
      </li>
      <li class="list-group-item">
        <b>Coaches</b> <a class="float-right">15</a>
      </li>
    </ul>

    <a href="{{ route('show.cities') }}" class="btn btn-warning btn-block"><b>Back</b></a>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
