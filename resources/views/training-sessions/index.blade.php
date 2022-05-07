@extends('layouts.app')
@section('page-title')
    All Training Sessions
@endsection
@section('content')
    <div class="text-center mb-4">
        <a href="{{ route('training-sessions.create') }}" class="btn btn-primary"><i class="fa fa-plus mr-1"></i>Add
            Training Session</a>
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
                        ajax: "{{ route('training-sessions.ajax') }}",
                        columns: [
                            {data: 'id', name: 'id'},
                            {data: 'name', name: 'name'},
                            {data: 'day', name: 'day'},
                            {data: 'start_time', name: 'start_time'},
                            {data: 'finish_time', name: 'finish_time'},
                            {data: 'Gym Name', name: 'Gym Name'},
                            {data: 'action', name: 'action', orderable: false, searchable: false},
                        ]
                    });
                });
            </script>
    @endpush
