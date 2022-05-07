@extends('layouts.app')

@section('content-header')
<!-- Content Header (Page header) -->
<section class="content-header">
    <div class="container-fluid">
        <div class="row mb-2">
            <div class="col-sm-6">
                <h1>DataTables</h1>
            </div>
            <div class="col-sm-6">
                <ol class="breadcrumb float-sm-right">
                    <li class="breadcrumb-item"><a href="{{route('/home')}}">Home</a></li>
                    <li class="breadcrumb-item active">DataTables</li>
                </ol>
            </div>
        </div>
    </div><!-- /.container-fluid -->
    @endsection
    @section('content')


    <x-table-component :actions="false" title="{{$title}}" :headings="$headings">
{{--        @foreach($items as $item)--}}
{{--        <tr>--}}

{{--            <td>{{$item->user->name}}</td>--}}
{{--            <td>{{$item->user->email}}</td>--}}
{{--            <td>{{$item->user->avatar}}</td>--}}
{{--            <td>{{$item->national_id}}</td>--}}

{{--            <td>--}}
{{--                @if($item['is_banned'])--}}
{{--                <a href="gymmanagers/{{$item->id}}/ban" class="btn btn-success ml-2"><i class="fa fa-check"></i></a>--}}
{{--                @else--}}
{{--                <a href="gymmanagers/{{$item->id}}/ban" class="btn btn-danger ml-2"><i class="fa fa-ban"></i></a>--}}
{{--                @endif--}}
{{--            </td>--}}
{{--            <td>{{$item->user->id}}</td>--}}


{{--            <td class="d-flex align-items-center">--}}
{{--                <a href="gymmanagers/{{$item->id}}" class="btn btn-info"><i class="fa fa-eye"></i></a>--}}
{{--                <a href="gymmanagers/{{$item->id}}/edit" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>--}}
{{--                <a href="{{route('gymmanagers.destroy', ['gymmanagerid' => $item->id])}}" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-times"></i></a>--}}

{{--            </td>--}}
{{--            <td>--}}
{{--                @if($gymManager['is_approved'])--}}
{{--                <a href="gymmanagers/{{$item->id}}/approve" class="btn btn-success ml-2"><i class="fa fa-check"></i></a>--}}
{{--                @else--}}
{{--                <a href="gymmanagers/{{$item->id}}/approve" class="btn btn-danger ml-2"><i class="fa fa-ban"></i></a>--}}
{{--                @endif--}}
{{--            </td>--}}
{{--        </tr>--}}
{{--        @endforeach--}}

    </x-table-component>

        <a class="btn btn-primary" href="{{route('gymmanagers.create')}}" >
            Add Gym Manager

        </a>
    @endsection

    @push('page_scripts')
        <script type="text/javascript">
            $(function () {

                var table = $('.datatable').DataTable({
                    processing: true,
                    serverSide: true,
                    ajax: "{{ route('gymmanagers.index') }}",
                    columns: [
                        {data: 'manager_name', name: 'Manager Name'},
                        {data: 'gym_name', name: 'Gym Name'},
                        {data: 'national_id', name: 'National ID'},
                        {data: 'avatar', name: 'Avatar'},
                        {data: 'action', name: 'action', orderable: false, searchable: false},
                    ]
                });

            });
        </script>
@endpush
