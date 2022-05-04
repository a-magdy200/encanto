@extends('layouts.app')

@section('content')
<br>
<div class="card card-primary card-outline">
    <div class="card-body box-profile">
        <div class="text-center">
            <img class="profile-user-img img-fluid img-circle" style="width:100px;height:100px;"src="" alt="User profile picture">
        </div>

        <h3 class="profile-username text-center">{{auth()->user()->name}}</h3>

        <p class="text-muted text-center">{{auth()->user()->role->name}}
        <ul class="list-group list-group-unbordered mb-3">
            <li class="list-group-item">
                <b>Email</b> <a class="float-right">{{auth()->user()->email}}</a>
            </li>
        </ul>

    </div>
    <!-- /.card-body -->
</div>

@endsection