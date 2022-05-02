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
@endsection
