@extends('layouts.app')

@section('title')Create @endsection

@section('content')

<form method="POST" action="{{ route('packages.store')}}" enctype="multipart/form-data">
    @csrf
    <div class="mb-3">
        <label for="exampleFormControlInput1" class="form-label">Package Name</label>
        <input name="package_name" type="text" class="form-control" id="exampleFormControlInput1" placeholder="">
    </div>
    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Session Numbers</label>
        <input name="sessions_number" type="text" class="form-control" id="exampleFormControlTextarea1" placeholder="">
    </div>

    <div class="mb-3">
        <label for="exampleFormControlTextarea1" class="form-label">Price in cents</label>
        <input name="price_in_cents" type="text" class="form-control" id="exampleFormControlTextarea1" placeholder="">
    </div>

    <button class="btn btn-success">Create</button>
</form>
@endsection