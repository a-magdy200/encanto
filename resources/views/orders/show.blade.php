@extends('layouts.app')

@section('content')
<div class="card card-primary">

    <div class="card-header">
        <h3 class="card-title">Order {{$order->id}}</h3>
    </div>
    <div class="card-body">
        <strong><i class="fas fa-book mr-1"></i> Order Info</strong>
        <p class="text-muted">
          <strong> User Name</strong> {{$order->user->name}}<br>
          <strong> Package Name:</strong> {{$order->trainingpackage->package_name}}<br>
          <strong> Number of Sessions:</strong> {{$order->number_of_sessions}}<br>
          <strong> Package Price:</strong> {{$order->price}}<br>

        </p>
    </div>
</div>
@endsection