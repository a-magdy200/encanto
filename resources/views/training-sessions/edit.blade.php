@extends('layouts.app')
@section('page-title')
    Update Training Session
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
<form method="post" action="{{ route('training-sessions.update',['trainingSession'=>$trainingSession])}}">
    @method("PUT")
    @csrf

    <div class="form-group">
        <label for="session_day">Session Day</label>
        <input type="text" id="session_day" class="form-control" name="day" value="{{$trainingSession->day}}" >
    </div>

    <div class="form-group">
        <label for="session_start_time">Session Start Time</label>
        <input id="session_start_time" type="time" class="form-control" name="start_time" value="{{$trainingSession->start_time}}" >
    </div>
    <div class="form-group">
        <label for="session_end_time">Session End Time</label>
        <input id="session_end_time" type="time" class="form-control" name="finish_time" value="{{$trainingSession->finish_time}}" >
    </div>

    <button class="btn btn-success">Confirm</button>

</form>

@endsection
