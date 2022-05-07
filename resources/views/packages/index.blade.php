@extends('layouts.app')
@section("page-title")
    Training Packages
@endsection
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Training Packages</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('/home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Training Packages</li>
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
                    $('.datatable').DataTable({
                        buttons: ["copy", "csv", "excel", "pdf", "print", "colvis"],
                        responsive: true,
                        dom: 'Bfrtip',
                        pageLength: 10,
                        paging: true,
                        lengthChange: false,
                        searching: true,
                        ordering: true,
                        info: false,
                        autoWidth: false,
                        processing: true,
                        serverSide: true,
                        ajax: "{{ route('packages.ajax') }}",
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'package_name', name: 'package_name'},
                            {data: 'number_of_sessions', name: 'number_of_sessions'},
                            {data: 'gym', name: 'gym'},
                            {data: 'price', name: 'price'},
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ]
                    });

                });
            </script>
    @endpush
