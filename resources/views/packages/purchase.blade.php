@extends('layouts.app')
@section('title')Purchase a package @endsection
@section('content')
<form method="post" action="{{ route('packages.order')}}">
    @csrf
    <div class="card-body">
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">User</label>
            <select name="client_id" class="form-control">
                @foreach ($clients as $client)
                <option value="{{$client->id}}">{{$client->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Training Package</label>
            <select name="package_id" class="form-control">
                @foreach ($packages as $package)
                <option value="{{$package->id}}">{{$package->package_name}}</option>
                @endforeach
            </select>
        </div>

        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Gym</label>
            <select name="gym_id" class="form-control">
                @foreach ($gyms as $gym)
                <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    <!-- /.card-body -->
    <div class="card-footer">
        <button type="submit" class="btn btn-primary">Purchase</button>
    </div>
</form>

@endsection