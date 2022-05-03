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
  <a href="{{ route('citymanagers.create') }}" class="btn btn-primary"><b>Add Manager</b></a>
</div>
      <x-table-component resource="citymanagers" :bannable="true" :actions="true" title="{{$title}}" :headings="$headings" :items="$items"/>
      <x-table-component  :actions="true" title="{{$title}}" :headings="$headings" >
          @foreach($items as $item)
              <tr>
                  @foreach($item as $key => $value)
                      @if($key === 'is_banned')
                          <td>
                              @if($item['is_banned'])
                                  <a href="users/restore" class="btn btn-success ml-2">Unban<i class="fa fa-check"></i></a>
                              @else
                                  <a href="users/ban" class="btn btn-danger ml-2"><i class="fa fa-ban"></i></a>
                              @endif
                          </td>
                      @else
                          <td>{{$value}}</td>
                      @endif
                  @endforeach
                  <td class="d-flex align-items-center">
                      <a href="users/{{$item['id']}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                      <a href="users/{{$item['id']}}/edit" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>
                      <a href="users/{{$item['id']}}/delete" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-times"></i></a>
                  </td>
              </tr>
          @endforeach
      </x-table-component>
@endsection
