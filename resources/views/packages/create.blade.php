@extends('layouts.app')

@section('page-title')
    Create Training Package
@endsection

@section('content')
@if ($errors->any())
    <div class="alert alert-danger">
        <ul>
            @foreach ($errors->all() as $error)
                <li>{{ $error }}</li>
            @endforeach
        </ul>
    </div>
@endif

<div class="card card-primary p-4">
    <h1 class="text-center mb-4">Create a new package</h1>
<form method="POST" action="{{ route('packages.store')}}">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Package Name</label>
        <input value="{{old("package_name")}}" name="package_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="Fitness...">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Session Numbers</label>
        <input value="{{old('number_of_sessions')}}" name="number_of_sessions" type="text" class="form-control" id="exampleFormControlTextarea1" placeholder="3...">
    </div>
    @if (!auth()->user()->hasRole('Gym Manager'))
    <div class="mb-3">
        <label for="exampleFormControlSelect" class="form-label">Gym</label>
        <select id="exampleFormControlSelect" name="gym_id" class="form-control">
                @foreach ($gyms as $gym)
                <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
        </select>
    </div>
    @endif
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Price in cents</label>
        <input value="{{old("price")}}" name="price" type="text" class="form-control" id="exampleFormControlTextarea1" placeholder="15..">
    </div>

    <button class="btn btn-success">Create</button>
</form>
</div>
@endsection
