@extends('layouts.app')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1 class=>Revenues</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Revenue</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    @endsection
    @section('content')
            <div class="container mt-5">
                <!-- Small boxes (Stat box) -->
                <div class="row">
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-info">
                            <div class="inner">
                                @if (auth()->user()->role_id === 1)
                                <h3>{{ $allClientsCount }}</h3>
                                @endif

                                @if (auth()->user()->role_id === 2)
                                <h3>{{ $cityClientsCount }}</h3>
                                @endif

                                @if (auth()->user()->role_id === 3)
                                <h3>{{ $gymClientsCount }}</h3>
                                @endif


                                <p>Number of Users</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-bag"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-success">
                            <div class="inner">
                                @if (auth()->user()->role_id === 1)
                                <h3>{{ $allOrdersCount }}<sup style="font-size:20px"></sup></h3>
                                @endif

                                @if (auth()->user()->role_id === 2)
                                <h3>{{ $cityOrdersCount }}<sup style="font-size:20px"></sup></h3>
                                @endif

                                @if (auth()->user()->role_id === 3)
                                <h3>{{ $gymOrdersCount }}</h3>
                                @endif

                                <p>Number of Orders</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-stats-bars"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                    <div class="col-lg-4 col-6">
                        <!-- small box -->
                        <div class="small-box bg-warning">
                            <div class="inner">
                                @if (auth()->user()->role_id === 1)
                                <h3>${{ $totalRevenues/100 }}</h3>
                                @endif

                                @if (auth()->user()->role_id === 2)
                                <h3>${{ $cityRevenues/100}}</h3>
                                @endif

                                @if (auth()->user()->role_id === 3)
                                <h3>${{ $gymRevenues/100 }}</h3>
                                @endif
                                
                                <p>Total Revenues</p>
                            </div>
                            <div class="icon">
                                <i class="ion ion-person-add"></i>
                            </div>
                        </div>
                    </div>
                    <!-- ./col -->
                </div>
                <!-- /.row -->
            </div>
        
     @endsection