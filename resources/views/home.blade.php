@extends('layouts.app')

@section('content')
    <div class="container-fluid">

        @if(auth()->user()->hasRole('Super Admin'))
            <div class="row">
                @foreach($stats as $stat)
                <div class="col-lg-4 col-6">
                    <!-- small box -->
                    <div class="small-box bg-info">
                        <div class="inner">
                            <h3>{{ $stat['value'] }}</h3>
                            <p>{{$stat['key']}}</p>
                        </div>
                        <div class="icon">
                            <i class="ion ion-bag"></i>
                        </div>
                    </div>
                </div>
                @endforeach
            </div>
        @endif
    </div>
@endsection
