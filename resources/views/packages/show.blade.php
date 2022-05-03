@extends('layouts.app')

@section('title')View @endsection

@section('content')
<div class="container p-5">
    <div class="card mb-5">
        <div class="card-header">
            Package Information
        </div>
        
        <div class="card-body">
            <p class="lead"><strong>Package Name: </strong>{{$items->package_name}}</p>
            <p class="lead"><strong>Session Numbers: </strong>{{$items->sessions_number}}</p>
            <p class="lead"><strong>Price in dollars: </strong>{{$items->price_in_cents/100}}</p>
        </div>
    </div>
</div>
@endsection


