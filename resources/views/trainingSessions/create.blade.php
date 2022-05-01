@extends('layouts.app')

@section('content')
<form method="post" action="{{ route('trainingSessions.store')}}">
    @csrf
    <div class="form-group">
        <label>Session Name</label>
        <input type="text" class="form-control" name="SessionName" >
    </div>

    <div class="form-group">
        <label>Session Day</label>
        <input type="date" class="form-control" name="day" >
    </div>

    <div class="form-group">
        <label>Session Start Time</label>
        <input type="time" class="form-control" name="starttime" >
    </div>
    <div class="form-group">
        <label>Session End Time</label>
        <input type="time" class="form-control" name="endtime" >
    </div>

    <div class="form-group">
        <label>Coach Name</label>
        <select class="form-control" name="userid">
            @foreach($users as $user)
            <option  name="userid" value="{{$user->id}}">{{$user->name}}</option>
            @endforeach
        </select>
    </div>
    <div class="form-group">
        <label>Gym Name</label>
        <select class="form-control" name="gymid">
            @foreach($gyms as $gym)
            <option  name="gymid" value="{{$gym->id}}">{{$gym->name}}</option>
            @endforeach
        </select>
    </div>
    <button class="btn btn-success">Add Session</button>

</form>

@endsection