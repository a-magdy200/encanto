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

            </x-table-component>
            <div class="text-center">
                <a href="{{route('coaches.create')}}" class="mt-4 btn btn-primary">add coach</a>
            </div>
@endsection
        @push('page_scripts')
        <script type="text/javascript">
            $(function () {

                var table = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('coaches.index') }}",
                    columns: [

                        {data: 'name', name: 'name'},
                        {data: 'email', name: 'email'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });

            });
        </script>
    @endpush
