@extends('layouts.app')
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>DataTables</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">DataTables</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    @endsection
    @section('content')
        <div class="text-center mb-3">
            <a href="{{ route('citymanagers.create') }}" class="btn btn-primary">
                Add City Manager
            </a>
        </div>
        <x-table-component :actions="true" title="{{ $title }}" :headings="$headings">

                @foreach ( $cityManagers as $cityManager)
                  <tr>
                    <td>{{ $cityManager['id'] }}</th>
                    <td>{{$cityManager['name']  }}</td>
                    <td>{{$cityManager->manager->city->name }}</td>
                    <td class="d-flex align-items-center">
                        <a href="citymanagers/{{ $cityManager['id'] }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                        <a href="citymanagers/{{ $cityManager['id'] }}/edit" class="btn btn-warning mx-2"><i
                                class="fa fa-edit"></i></a>
                        <a href="citymanagers/{{ $cityManager['id'] }}/delete" class="btn btn-danger delete-btn" data-toggle="modal"
                            data-target="#delete-modal"><i class="fa fa-times"></i></a>
                    </td>
                  </tr>
                  @endforeach


        </x-table-component>
    @endsection
