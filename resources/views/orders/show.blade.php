@extends('layouts.app')
@section('page-section')
    Order Details
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-body">
        <strong><i class="fas fa-book mr-1"></i> Order Info</strong>
        <p class="text-muted">
          <strong> User Name</strong> {{$order->client->user->name}}<br>
          <strong> Package Name:</strong> {{$order->trainingpackage->package_name}}<br>
          <strong> Number of Sessions:</strong> {{$order->number_of_sessions}}<br>
          <strong> Package Price:</strong> {{$order->price}}<br>
          <strong> Order Date:</strong> {{$order->created_at}}<br>
        </p>
    </div>
</div>
@endsection
