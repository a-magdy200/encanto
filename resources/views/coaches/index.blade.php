@extends('layouts.app')
@section("page-title")
    All Coaches
@endsection
@section('content-header')
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Clients</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Coaches</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        @endsection
        @section('content')

            <div class="text-center mb-4">
                <a href="{{route('coaches.create')}}" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Add Coach</a>
            </div>
            <x-table-component :actions="true" title="{{$title}}" :headings="$headings" />
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
