@extends('layouts.app')
@section('page-title')
    Add Attendance
@endsection
@section('content')


    <form method="post" action="{{route('attendance.store')}}">
        @csrf

        <div class="card-body">



            <div class="mb-3">
                <label for="client_id" class="form-label">Client</label>
                <select id="client_id"  name="client_id" class="form-control @error('client_id') is-invalid @enderror">
                    @foreach ($clients as $client)
                        <option @selected(old("client_id") == $client->id) value="{{$client->id}}">{{$client->user->name}}</option>
                    @endforeach
                </select>
                @error('client_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="training_session" class="form-label">Session</label>
                <select id="training_session" name="training_session_id" class="form-control @error('training_session_id') is-invalid @enderror">
                    @foreach ($trainingSessions as $trainingSession)
                        <option @selected(old("training_session_id") == $trainingSession->id) value="{{$trainingSession->id}}">{{$trainingSession->name}}</option>
                    @endforeach
                </select>
                @error('training_session_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

            <div class="mb-3">
                <label for="date">Attendance Date</label>
                <input value="{{old("date")}}" id="date" type="datetime-local" name="date" class="form-control @error('date') is-invalid @enderror" placeholder="">
                @error('date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>


        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Add</button>
        </div>
    </form>

@endsection
