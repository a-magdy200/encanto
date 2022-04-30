@extends('layouts.app')

@section('title')Edit @endsection

@section('content')
<form method="POST" action="{{ route('packages.update',['package' => $packages->id])}}">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Package Name</label>
        <input name="package_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="{{ $packages->package_name}}">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Session Numbers</label>
        <input name="sessions_number" class="form-control" id="exampleFormControlTextarea1" placeholder="{{ $packages->sessions_number}}">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Price in cents</label>
        <input name="price_in_cents" type="text" class="form-control" id="exampleFormControlTextarea1" placeholder="{{ $packages->price_in_cents}}">
    </div>
    @method('PUT')
    <button class="btn btn-primary">Update</button>
</form>
@endsection