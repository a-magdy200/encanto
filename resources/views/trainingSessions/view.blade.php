@extends('layouts.app')

@section('content')
<div class="card card-primary">
    <div class="card-header">
        <h3 class="card-title">Training Session</h3>

        <div class="card-tools">
            <button type="button" class="btn btn-tool" data-card-widget="collapse" title="Collapse">
                <i class="fas fa-minus"></i>
            </button>
        </div>
    </div>
    <div class="card-body">

        <strong><i class="fas fa-book mr-1"></i> Session Info</strong>
        <p class="text-muted">
            <strong> Session Name</strong> {{$trainingSession->name}}<br>
            <strong> Day </strong> {{$trainingSession->day}}<br>
            <strong> Start Time</strong> {{$trainingSession->start_time}}<br>
            <strong> Finish Time</strong> {{$trainingSession->finish_time}}<br>
            <strong> Gym Name</strong> {{$trainingSession->gym->name}}<br>

        </p>

    </div>
</div>
@endsection