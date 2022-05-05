@extends('layouts.app')
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/4.1.3/css/bootstrap.min.css" />

    <link href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

    <link href="https://cdn.datatables.net/1.10.19/css/dataTables.bootstrap4.min.css" rel="stylesheet">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.9.1/jquery.js"></script>  

    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery-validate/1.19.0/jquery.validate.js"></script>

    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>

    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"></script>

    <script src="https://cdn.datatables.net/1.10.19/js/dataTables.bootstrap4.min.js"></script>

@section('content')
<div class="text-center">
    <a href="{{ route('orders.create') }}" class="mt-4 btn btn-success">Create </a>
</div><br>
<x-table-component :actions="true" title="{{$title}}" :headings="$headings">
   
</x-table-component>

@endsection
<script>
    (function($) {

        $('#datatable').DataTable({
            "serverSide": true,
            "processing": true,
            "ajax": {
                "url": "{{ url('orders.index') }}",
                "dataType": "json",
                "type": "POST",
                "data": {
                    _token: "{{csrf_token()}}"
                }
            },
            "columns": [{
                    "data": "id"
                },
                {
                    "data": "client_id"
                },
                {
                    "data": "package_id"
                },
                {
                    "data": "number_of_sessions"
                },
                {
                    "data": "price"
                }
            ]

        });

    });
</script>