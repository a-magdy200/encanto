@extends('layouts.app')
@section('page-title')
    Edit Password
@endsection
@section('content')

    <form class="mt-3" method="post" action="{{ route('profile.updatepass')}}">
        @method("PUT")
        @csrf
        <div class=" form-group mb-3">
            <label>Password</label><br>
            <input type="password" name="password" class="form-control @error('password') is-invalid @enderror"
                   placeholder="Password">

            @error('password')
            <span class="invalid-feedback" role="alert">
            <strong>{{ $message }}</strong>
        </span>
            @enderror
        </div>

        <div class=" form-group  mb-3">
            <label>Confirm Password</label><br>
            <input type="password" name="password_confirmation" class="form-control" placeholder="Retype password">

        </div>

        <button class="btn btn-success">Update password</button>

    </form>

@endsection
