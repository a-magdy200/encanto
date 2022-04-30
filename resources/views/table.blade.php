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
      <div class="container-fluid">
        <div class="row">
          <div class="col-12">
            <div class="card">
              <div class="card-header">
                <h3 class="card-title">{{$title}}</h3>
              </div>
              <!-- /.card-header -->
              <div class="card-body">
                <table id="datatable" class="datatable table table-bordered table-striped">
                  <thead>
                  <tr>
                  @foreach($headings as $heading)
                    <th>{{$heading}}</th>
                  @endforeach
                  </tr>
                  </thead>
                  <tbody>
                  @foreach($items as $item)
                  <tr>
                    @foreach($item as $key => $value)
                        <td>{{$value}}</td>
                    @endforeach
                  </tr>
                  @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.card-body -->
            </div>
            <!-- /.card -->
          </div>
          <!-- /.col -->
        </div>
        <!-- /.row -->
      </div>
        @endsection
