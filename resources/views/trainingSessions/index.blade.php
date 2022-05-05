@extends('layouts.app')

@section('content')
<div class="text-center">
  <a href="{{ route('trainingSessions.create') }}" class="mt-4 btn btn-success">Create </a>
</div><br>
<x-table-component  :actions="true" title="{{$title}}" :headings="$headings" >

</x-table-component>

@endsection
@push('page_scripts')
<script type="text/javascript">
    $(function () {
    var table = $('.datatable').DataTable({
        processing: true,
        serverSide: true,
        ajax: "{{ route('trainingSessions.index') }}",

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