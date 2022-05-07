@extends('layouts.app')
@section("page-title")
    Attendance List
@endsection
@section('content-header')
    <!-- Content Header (Page header) -->

    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Attendance List</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="#">Home</a></li>
                        <li class="breadcrumb-item active">Attendance</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        @endsection
        @section('content')
            <x-table-component :actions="true" title="{{$title}}" :headings="$headings">
            </x-table-component>
            <div class="text-center">
                <a href="{{route('attendance.create')}}" class="mt-4 btn btn-primary">Add Attendance</a>
            </div>
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
                        ajax: "{{ route('attendance.index') }}",
                        columns: [

                            {data: 'name', name: 'name'},
                            {data: 'email', name: 'email'},
                            {data: 'date', name: 'date'},
                            {data: 'time', name: 'time'},
                            {data: 'training_session', name: 'training_session'},

                            {data: 'gym', name: 'gym'},
                            {data: 'city', name: 'city'},


                            {data: 'action', name: 'action', orderable: true, searchable: true},
                        ]
                    });

                });
            </script>
    @endpush
