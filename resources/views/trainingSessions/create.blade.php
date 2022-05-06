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
<form method="post" action="{{ route('trainingSessions.store')}}">
    @csrf
    <div class="form-group">
        <label>Session Name</label>
        <input type="text" class="form-control" name="SessionName" value="{{ old('SessionName') }}">
    </div>

    <div class="form-group">
        <label>Session Day</label>
        <input type="date" class="form-control" name="day" value="{{old('day') }}">
    </div>

    <div class="form-group">
        <label>Session Start Time</label>
        <input type="time" class="form-control" name="starttime" value="{{old('starttime') }}">
    </div>
    <div class="form-group">
        <label>Session End Time</label>
        <input type="time" class="form-control" name="endtime" value="{{old('finishtime') }}">
    </div>

    <div class="form-group">
        <div class="select2-purple">
            <label>Coach Name</label>
            <select id="userid" name="users[]" class="select2" multiple="multiple" data-placeholder="select coach" data-dropdown-css-class="select2-purple" style="width: 100%" ;>
                @foreach($users as $user)
                <option value="{{$user->id}}">{{$user->name}}</option>
                @endforeach
            </select>
        </div>
    </div>
    @if (!auth()->user()->hasRole('Gym Manager'))
    <div class="form-group">
        <label>Gym Name</label>
        <select class="form-control" name="gymid">
            @foreach($gyms as $gym)
            <option @if($gym->id == Session::get('gym_id') ) selected @endif value="{{$gym->id}}">{{$gym->name}}</option>
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