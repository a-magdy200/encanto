@extends('layouts.app')
@section("page-title")
    Gym Managers List
@endsection
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gym Managers</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Gym Managers</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
        @endsection
        @section('content')
            <div class="d-flex justify-content-center mb-4">
                <a class="btn btn-primary" href="{{route('gym-managers.create')}}">
                    <i class="fa fa-plus mr-1"></i>
                    Add Gym Manager
                </a>
            </div>
            <x-table-component :actions="false" title="{{$title}}" :headings="$headings"/>
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
                        ajax: "{{ route('gym-managers.index') }}",
                        columns: [
                            {data: 'manager_name', name: 'Manager Name'},
                            {data: 'gym_name', name: 'Gym Name'},
                            {data: 'avatar', name: 'Avatar'},
                            {data: 'national_id', name: 'National ID'},
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ]
                    });

                });
            </script>
    @endpush
