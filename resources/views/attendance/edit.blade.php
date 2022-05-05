@extends('layouts.app')
@section('content')


    <form method="post" action="{{route('attendance.update',['attendance'=>$attendance->id])}}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="card-body">



            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">user name</label>
                <select  name="client_id" class="form-control @error('client_id') is-invalid @enderror">
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}">{{$client->user->name}}</option>
                    @endforeach
                </select>
                @error('client_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">training seesion</label>
                <select  name="training_session_id" class="form-control @error('training_session_id') is-invalid @enderror">
                    @foreach ($trainingSessions as $trainingSession)
                        <option value="{{$trainingSession->id}}">{{$trainingSession->name}}</option>
                    @endforeach
                </select>
                @error('training_session_id')
                <div class="alert alert-danger">{{ $message }}</div>
                @enderror
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1">attend at</label>
                <input type="datetime-local"  name ="date" class="form-control @error('date') is-invalid @enderror" id="exampleInputPassword1" placeholder="">
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
