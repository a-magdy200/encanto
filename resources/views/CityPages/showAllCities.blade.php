@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center mb-4 pt-4">
    <a href="{{ route('show.addCity') }}" class="btn btn-primary ">Add City</a>
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
        ajax: "{{ route('show.cities') }}",
        columns: [

            {data: 'name', name: 'name'},
            {data: 'action', name: 'action', orderable: true, searchable: true},
            ]
        });

      });
    </script>
@endpush
