@extends('layouts.app')

@section('content')
<div class="text-center">
    <a href="{{ route('orders.create') }}" class="mt-4 btn btn-success">Create </a>
</div><br>
<x-table-component :actions="true" title="{{$title}}" :headings="$headings">
   
</x-table-component>

@endsection
@push('page_scripts')
<script type="text/javascript">
    $(function () {
    var table = $('.datatable').DataTable({
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