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
<form method="post" action="{{ route('training-sessions.store')}}">
    @csrf
    <div class="form-group">
        <label for="session_name">Session Name</label>
        <input type="text" id="session_name" placeholder="Salsa..." class="form-control" name="SessionName" value="{{ old('SessionName') }}">
    </div>

    <div class="form-group">
        <label for="session_day">Session Day</label>
        <input type="date" id="session_day" class="form-control" name="day" value="{{old('day') }}">
    </div>

    <div class="form-group">
        <label for="session_time">Session Start Time</label>
        <input type="time" id="session_time" class="form-control" name="start_time" value="{{old('start_time') }}">
    </div>
    <div class="form-group">
        <label for="session_finish_time">Session End Time</label>
        <input type="time" id="session_finish_time" class="form-control" name="finish_time" value="{{old('finish_time') }}">
    </div>

    <div class="form-group">
        <div class="select2-purple">
            <label for="coach_select">Coach Name</label>
            <select id="coach_select" name="users[]" class="select2" multiple="multiple" data-placeholder="select coach" data-dropdown-css-class="select2-purple" style="width: 100%" ;>
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if (auth()->user()->hasAnyRole('City Manager', 'Super Admin'))
    <div class="form-group">
        <label for="gym_id">Gym Name</label>
        <select id="gym_id" class="form-control" name="gym_id">
            @foreach($gyms as $gym)
            <option @selected(old("gym_id") == $gym->id) value="{{$gym->id}}">{{$gym->name}}</option>
            @endforeach
        </select>
    </div>
    @endif
    <button class="btn btn-success">Add Session</button>

</form>

@endsection

<script>
    $(function() {
        //Initialize Select2 Elements
        $('.select2').select2();

        //Initialize Select2 Elements
        $('.select2bs4').select2({
            theme: 'bootstrap4'
        });
    })
</script>
