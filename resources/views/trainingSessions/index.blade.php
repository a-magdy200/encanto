@extends('layouts.app')

@section('content')
<div class="text-center">
  <a href="{{ route('trainingSessions.create') }}" class="mt-4 btn btn-success">Create </a>
</div><br>
<x-table-component  :actions="true" title="{{$title}}" :headings="$headings" >
@foreach($items as $item)
              <tr>
                 
                  <td>{{$item->id}}</td>
                  <td>{{$item->name}}</td>
                  <td>{{$item->day}}</td>
                  <td>{{$item->start_time}}</td>
                  <td>{{$item->finish_time}}</td>
                  <td>{{$item->gym->name}}</td>
                  <td class="d-flex align-items-center">
                      <a href="trainingSessions/{{$item['id']}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                      <a href="trainingSessions/{{$item['id']}}/edit" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>
                      <a href="trainingSessions/{{$item['id']}}/delete" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-times"></i></a>
                  </td>
              </tr>
          @endforeach
</x-table-component>

@endsection