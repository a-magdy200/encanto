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

  </x-table-component>
  @endsection
  @push('page_scripts')
  <script type="text/javascript">
  $(function () {
    var table = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('packages.index') }}",
        columns: [
            {data: 'id', name: 'id'},
            {data: 'package_name', name: 'package_name'},
            {data: 'number_of_sessions', name: 'number_of_sessions'},
            {data: 'gym_id', name: 'gym_id'},
            {data: 'price', name: 'price'},
            {data: 'created_at', name: 'created_at'},
            {data: 'updated_at', name: 'updated_at'},
            {data: 'action', name: 'action', orderable: false, searchable: false},
        ]
    });

  });
</script>
@endpush
