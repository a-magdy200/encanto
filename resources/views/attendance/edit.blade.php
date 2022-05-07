@extends('layouts.app')
@section('content')


    <form method="post" action="{{route('attendance.update',['attendance'=>$attendance])}}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="card-body">



            <div class="mb-3">
                <label for="client_id" class="form-label">Client</label>
                <select id="client_id" name="client_id" class="form-control @error('client_id') is-invalid @enderror">
                    @foreach ($clients as $client)
                        <option @selected($attendance->client_id == $client->id) value="{{$client->id}}">{{$client->user->name}}</option>
                    @endforeach
                </select>
                @error('client_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="training_session" class="form-label">training seesion</label>
                <select id="training_session" name="training_session_id" class="form-control @error('training_session_id') is-invalid @enderror">
                    @foreach ($trainingSessions as $trainingSession)
                        <option  @selected($attendance->training_session_id == $trainingSession->id) value="{{$trainingSession->id}}">{{$trainingSession->name}}</option>
                    @endforeach
                </select>
                @error('training_session_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="attended_at">Attendance Date</label>
                <input value="{{$attendance->attended_at}}" id="attended_at" type="datetime-local"  name ="date" class="form-control @error('date') is-invalid @enderror" placeholder="">
                @error('date')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">update</button>
        </div>
    </form>

@endsection
