@extends('layouts.app')

@section('title')Delete @endsection

@section('content')
<div class="container p-5">
    <form method="post" action="{{route('packages.destroy',['package' => $packages->id])}}>
        <p class="lead text-center">Are you sure you want to delete this post?</p>
        <div class="d-flex justify-content-center align-items-center">
            <div class="px-2">
                <button class="btn btn-danger" type="submit"> Confirm</button>
            </div>
            <div class="px-2">
                <a href="{{route('packages.index')}}" class="ml-2 btn btn-light">Cancel</a>
            </div>
        </div>
        @method('DELETE')
        @csrf
    </form>
</div>
@endsection
    
