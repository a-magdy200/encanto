@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('trainingSessions.update',['id'=>$trainingSession->id])}}">
    @method("PUT")
    @csrf
    
    <div class="form-group">
        <label>Session Name</label>
        <input type="text" class="form-control" name="SessionName"value="{{$trainingSession->name}}" >
    </div>

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

    <div class="form-group">
        <label>Gym</label>
        <select class="form-control" name="gymid">
            @foreach($gyms as $gym)
            <option @if($trainingSession->gym_id == $gym->id) selected @endif name="gym_id" value="{{$gym->id}}">{{$gym->name}}</option>
            @endforeach
        </select>
    </div>
   

    
    <button class="btn btn-success">Confirm</button>

</form>

@endsection