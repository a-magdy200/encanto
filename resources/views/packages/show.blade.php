@extends('layouts.app')

@section('page-title')
    Training Package Details
@endsection

@section('content')
    <div class="container p-5">
        <div class="card mb-5">
            <div class="card-header d-flex align-items-center justify-content-between">
                <h1>Package Information</h1>
                <a href="{{route("packages.edit", ["package" => $package])}}" class="btn btn-success"><i class="fa fa-edit mr-1"></i>Edit</a>
            </div>

            <div class="card-body">
                <p class="lead"><strong>Package Name: </strong>{{$package->package_name}}</p>
                <p class="lead"><strong>Sessions Count: </strong>{{$package->number_of_sessions}}</p>
                <p class="lead"><strong>Gym: </strong>{{$package->gym->name}}</p>
                <p class="lead"><strong>Price in USD($): </strong>{{$package->price/100}}<i class="fa fa-dollar-sign ml-1"></i></p>
                <p class="lead"><strong>Orders Count: </strong>{{$package->orders->count()}}</p>
            </div>
        </div>
    </div>
@endsection


