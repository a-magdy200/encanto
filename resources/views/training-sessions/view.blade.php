@extends('layouts.app')
@section('page-title')
    Training Session Details
@endsection
@section('content')
<div class="card card-primary">
    <div class="card-body">
        <div class="d-flex align-items-center justify-content-between">
            <h2><i class="fas fa-book mr-1"></i> Session Info</h2>
            <a href="{{route('training-sessions.edit', ['trainingSession' => $trainingSession])}}" class="btn btn-success"><i class="fa fa-edit mr-1"></i></a>
        </div>
        <p class="text-muted">
            <strong> Session Name</strong> {{$trainingSession->name}}<br>
            <strong> Day </strong> {{$trainingSession->day}}<br>
            <strong> Start Time</strong> {{$trainingSession->start_time}}<br>
            <strong> Finish Time</strong> {{$trainingSession->finish_time}}<br>
            <strong> Gym Name</strong> {{$trainingSession->gym->name}}<br>
            <strong> Attendance Count </strong> {{$trainingSession->attendance ? $trainingSession->attendance->count() : 0}}<br>
        </p>

    </div>
</div>
@endsection
