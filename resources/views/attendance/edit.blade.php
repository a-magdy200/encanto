@extends('layouts.app')
@section('content')


    <form method="post" action="{{route('attendance.update',['attendance'=>$attendance->id])}}" enctype="multipart/form-data">
        @csrf
        @method('put')

        <div class="card-body">



            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">user name</label>
                <select  name="client_id" class="form-control">
                    @foreach ($clients as $client)
                        <option value="{{$client->id}}">{{$client->user->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleFormControlTextarea1" class="form-label">training seesion</label>
                <select  name="training_session_id" class="form-control">
                    @foreach ($trainingSessions as $trainingSession)
                        <option value="{{$trainingSession->id}}">{{$trainingSession->name}}</option>
                    @endforeach
                </select>
            </div>
            <div class="mb-3">
                <label for="exampleInputPassword1">attend at</label>
                <input type="datetime-local"  name ="date" class="form-control" id="exampleInputPassword1" placeholder="">
            </div>

        </div>
        <!-- /.card-body -->

        <div class="card-footer">
            <button type="submit" class="btn btn-primary">update</button>
        </div>
    </form>

@endsection
