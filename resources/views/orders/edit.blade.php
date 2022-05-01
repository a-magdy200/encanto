@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('orders.update',['id'=>$order->id])}}">
    @method("PUT")
    @csrf
    <div class="form-group">
        <label>User</label>
        <select class="form-control" name="user_id">
            @foreach($users as $user)
            <option @if($order->user_id == $user->id) selected @endif name="user_id" value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Package</label>
        <select class="form-control" name="package_id">
            @foreach($packages as $package)
            <option @if($order->package_id == $package->id) selected @endif name="package_id" value="{{$package->id}}">{{$package->package_name}}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Number of sessions</label>
        <input type="text" class="form-control" name="number_of_sessions" value="{{$order->number_of_sessions}}">
    </div>

    <div class="form-group">
        <label>Price</label>
        <input type="text" class="form-control" name="order_price" value="{{$order->price}}">
    </div>

    <button class="btn btn-success">Order Now</button>

</form>

@endsection