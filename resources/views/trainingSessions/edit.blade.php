@extends('layouts.app')

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
<form method="post" action="{{ route('trainingSessions.update',['id'=>$trainingSession->id])}}">
    @method("PUT")
    @csrf
      
    <div class="form-group">
        <label>Session Day</label>
        <input type="text" class="form-control" name="day"value="{{$trainingSession->day}}" >
    </div>

    <div class="form-group">
        <label>Session Start Time</label>
        <input type="time" class="form-control" name="starttime"value="{{$trainingSession->start_time}}" >
    </div>
    <div class="form-group">
        <label>Session End Time</label>
        <input type="time" class="form-control" name="finishtime"value="{{$trainingSession->finish_time}}" >
    </div>
     
    <button class="btn btn-success">Confirm</button>

</form>

@endsection