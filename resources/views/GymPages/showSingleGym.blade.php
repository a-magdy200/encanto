@extends('layouts.app')
@section('content')
<h1 class="text-center">Show Gym Data</h1>
<!-- Profile Image -->
<div class="card card-primary card-outline w-50">
  <div class="card-body box-profile ">
    <div class="text-center">

      <img class="profile-user-img img-fluid img-circle"
           src="{{ asset($Gym['cover_image']) }}"
           alt="Gym Cover Image">
    </div>

    <h3 class="profile-username text-center">{{ $Gym['name'] }}</h3>
    <ul class="list-group list-group-unbordered mb-3">
      <li class="list-group-item">
        <b>Gym Managers</b> <a class="float-right">3</a>
      </li>
      <li class="list-group-item">
        <b>Training Session</b> <a class="float-right">20</a>
      </li>
      <li class="list-group-item">
        <b>Coaches</b> <a class="float-right">15</a>
      </li>
    </ul>

    <a href="{{ route('show.AllGyms') }}" class="btn btn-warning btn-block"><b>Back</b></a>
  </div>
  <!-- /.card-body -->
</div>
<!-- /.card -->
@endsection
