@extends('layouts.app')

@section('page-title')
    Edit Package Details
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
    <form method="POST" action="{{ route('packages.update',['package' => $packages->id])}}">
        @csrf
        <div class="mb-3">
            <label for="exampleFormControlInput1" class="form-label">Package Name</label>
            <input name="package_name" type="text" class="form-control" id="exampleFormControlInput1"
                   value="{{ $packages->package_name}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Session Numbers</label>
            <input name="number_of_sessions" class="form-control" id="exampleFormControlTextarea1"
                   value="{{ $packages->number_of_sessions}}">
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Gym</label><select name="gym_id"
                                                                                           class="form-control">
                @foreach ($gyms as $gym)
                    <option value="{{$gym->id}}">{{$gym->name}}</option>
                @endforeach
            </select>
        </div>
        <div class="mb-3">
            <label for="exampleFormControlTextarea1" class="form-label">Price in cents</label>
            <input name="price" type="text" class="form-control" id="exampleFormControlTextarea1"
                   value="{{ $packages->price}}">
        </div>
        @method('PUT')
        <button class="btn btn-primary">Update</button>
    </form>
@endsection
