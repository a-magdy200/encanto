@extends('layouts.app')
@section("page-title")
    All Gyms
@endsection
@section('content-header')
    <!-- Content Header (Page header) -->
    <section class="content-header">
        <div class="container-fluid">
            <div class="row mb-2">
                <div class="col-sm-6">
                    <h1>Gyms</h1>
                </div>
                <div class="col-sm-6">
                    <ol class="breadcrumb float-sm-right">
                        <li class="breadcrumb-item"><a href="{{route('home')}}">Home</a></li>
                        <li class="breadcrumb-item active">Gyms</li>
                    </ol>
                </div>
            </div>
        </div><!-- /.container-fluid -->
    </section>
@endsection
@section('content')
    <div class="d-flex justify-content-center mb-4 pt-4">

        <a href="{{ route('gyms.create') }}" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Add Gym</a>
    </div>
    <x-table-component :actions="true" title="{{$title}}" :headings="$headings"/>

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
                ajax: "{{ route('gyms.index') }}",
                columns: [

                    {data: 'name', name: 'name'},
                    {data: 'Cover Image', name: 'Cover Image'},
                    @if(auth()->user()->hasRole('Super Admin'))
                    {data: 'City Name', name: 'City Name'},
                    {data: 'City Manager Name', name: 'City Manager Name'},
                    @endif
                    {data: 'Created At', name: 'Created At'},
                    {data: 'Created By', name: 'Created By'},
                    {data: 'action', name: 'action', orderable: false, searchable: false},
                ]
            });

        });
    </script>
@endpush
