@extends('layouts.app')
@section("page-title")
    Orders List
@endsection
@section('content')
    <div class="text-center mb-4">
        <a href="{{ route('packages.purchase') }}" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Create
            Order</a>
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
                ajax: "{{ route('orders.index') }}",

                columns: [

                    {data: 'id', name: 'id'},

                    {data: 'Client Name', name: 'Client Name'},

                    {data: 'Package Name', name: 'Package Name'},

                    {data: 'number_of_sessions', name: 'number_of_sessions'},

                    {data: 'price', name: 'price'},

                    {data: 'action', name: 'action', orderable: false, searchable: false},

                ]

            });


        });
    </script>
@endpush
