@extends('layouts.app')

@section('content')
<div class="text-center">
  <a href="{{ route('orders.create') }}" class="mt-4 btn btn-success">Create </a>
</div><br>
<x-table-component  :actions="true" title="{{$title}}" :headings="$headings" >
@foreach($items as $item)
              <tr>
                 
                  <td>{{$item->id}}</td>
                  <td>{{$item->client}}</td>
                  <td>{{$item->package->package_name}}</td>
                  <td>{{$item->number_of_sessions}}</td>
                  <td>{{$item->price}}</td>
                  <td class="d-flex align-items-center">
                      <a href="orders/{{$item['id']}}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                      <a href="orders/{{$item['id']}}/edit" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>
                      <a href="orders/{{$item['id']}}/delete" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-times"></i></a>
                  </td>
              </tr>
          @endforeach
</x-table-component>

@endsection