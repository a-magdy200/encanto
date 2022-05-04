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
            <x-table-component :actions="true" title="{{$title}}" :headings="$headings">
                @foreach($clients as $client)
                    <tr>


                        <td>{{$client->user->name}}</td>

                        <td>{{$client->user->email}}</td>


                        <td class="d-flex align-items-center">
                            <a href="{{route('clients.show',['client'=>$client->id])}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                            <a href="{{route('clients.edit',['client'=>$client->id])}}" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>
                            <a href="{{route('clients.delete',['client'=>$client->id])}}" class="btn btn-danger delete-btn" data-toggle="modal"
                               data-target="#delete-modal"><i class="fa fa-times"></i></a>
                        </td>
                    </tr>
                @endforeach
            </x-table-component>
            <div class="text-center">
                <a href="{{route('clients.create')}}" class="mt-4 btn btn-primary">add coach</a>
            </div>
@endsection
