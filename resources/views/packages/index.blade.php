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
  <div class="text-center">
    <a href="{{ route('packages.create') }}" class="mt-2 mb-4 btn btn-success">Create Package</a>
    <a href="{{ route('packages.purchase') }}" class="mt-2 mb-4 btn btn-success">Purchase Package</a>
  </div>

  <x-table-component :actions="true" title="{{$title}}" :headings="$headings">
    @foreach($items as $item)
    <tr>
      <td>{{$item['id']}}</td>
      <td>{{$item['package_name']}}</td>
      <td>{{$item['number_of_sessions']}}</td>
      <td>{{$item->gym->name}}</td>
      <td>{{$item['price']/100}}</td>
      <td>{{$item['created_at']}}</td>
      <td>{{$item['updated_at']}}</td>
      <td class="d-flex align-items-center">
        <a href="packages/{{$item['id']}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
        <a href="packages/{{$item['id']}}/edit" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>
        <a href="/packages/{{$item['id']}}/danger" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-times"></i></a>
      </td>
    </tr>
    @endforeach
  </x-table-component>
  @endsection