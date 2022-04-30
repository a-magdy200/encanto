@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('orders.update',['orderid'=>$order->id])}}">
    @csrf
    <div class="form-group">
        <label>User</label>
        <select class="form-control" name="user_id">
            @foreach($users as $user)
            <option @if($order->user_id == $user->id) selected @endif name="userid" value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Package</label>
        <select class="form-control" name="package_id">
            @foreach($packages as $package)
            <option @if($order->package_id == $package->id) selected @endif name="packageid" value="{{$package->id}}">{{$package->package_name}}</option>
            @endforeach
        </select>
    </div>
    
    <button class="btn btn-success">Order Now</button>

</form>

@endsection