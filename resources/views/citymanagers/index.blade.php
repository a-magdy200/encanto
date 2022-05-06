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
        <form action="{{ route('citymanagers.create') }}" class="get">
            <div class="text-center mb-3">
                <button type="submit" class="btn btn-primary">
                    Add City Manager
                </button>
            </div>
        </form>

        <x-table-component :actions="true" title="{{ $title }}" :headings="$headings">



        </x-table-component>
    @endsection
    @push('page_scripts');
        <script type="text/javascript">
            $(function() {
                var table = $('.datatable').DataTable({

                    processing: true,
                    serverSide: true,

                    ajax: "{{ route('citymanagers.index') }}",

                    columns: [

                        {
                            data: 'id',
                            name: 'id'
                        },

                        {
                            data: 'name',
                            name: 'name'
                        },

                        {
                            data: 'city',
                            name: 'city'
                        },
                        {
                            data: 'is_approved',
                            name: 'is_approved',
                            orderable: false,
                            searchable: false
                        },

                        {
                            data: 'action',
                            name: 'action',
                            orderable: false,
                            searchable: false
                        },

                    ]

                });



            });
        </script>
@endpush
