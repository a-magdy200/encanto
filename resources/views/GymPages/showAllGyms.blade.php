@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center mb-4 pt-4">

    <a href="{{ route('show.gymForm') }}" class="btn btn-primary">Add Gym</a>
</div>
    <x-table-component  :actions="true" title="{{$title}}" :headings="$headings" >

      </x-table-component>

@endsection
@push('page_scripts')
<script type="text/javascript">
    $(function () {

    var table = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('show.AllGyms') }}",
        columns: [

            {data: 'name', name: 'name'},
            {data: 'cover_image', name: 'cover_image'},
            {data: 'City Name', name: 'City Name'},
            {data:'Created_At',name:'Created_At'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });

      });
    </script>
@endpush
