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
        @foreach($items as $item)
        <tr>

            <td>{{$item->user->name}}</td>
            <td>{{$item->user->email}}</td>
            <td>{{$item->user->avatar}}</td>
            <td>{{$item->national_id}}</td>

            <td>
                @if($item['is_banned'])
                <a href="gummanagers/restore" class="btn btn-success ml-2">Unban<i class="fa fa-check"></i></a>
                @else
                <a href="gummanagers/ban" class="btn btn-danger ml-2"><i class="fa fa-ban"></i></a>
                @endif
            </td>
            <td>{{$item->user->id}}</td>


            <td class="d-flex align-items-center">
                <a href="gymmanagers/{{$item->user->id}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                <a href="gymmanagers/{{$item->user->id}}/edit" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>
                <a href="gymmanangers/{{$item->user->id}}/delete" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-times"></i></a>
            </td>
        </tr>
        @endforeach

    </x-table-component>

    <form method="get" action="{{route('gymmanagers.create')}}">
        <button type="submit">
            Add Gym Manager

        </button>
    </form>
    @endsection