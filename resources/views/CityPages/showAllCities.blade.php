@extends('layouts.app')
@section('content')

<div class="d-flex justify-content-center mb-4 pt-4">
    <a href="{{ route('show.addCity') }}" class="btn btn-primary ">Add City</a>
</div>
      <x-table-component  :actions="true" title="{{$title}}" :headings="$headings" >
          @foreach($cities as $city)
              <tr>
                <td>{{ $city->name }}</td>
                  <td class="d-flex align-items-center">
                      <a href="{{ route('show.singleCity',['cityId'=>$city['id']]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                      <a href="{{ route('edit.city',['cityId'=>$city['id']]) }}" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>
                      <a href="{{ route('delete.city',['cityId'=>$city['id'] ]) }}" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-times"></i></a>
                  </td>
              </tr>
          @endforeach
      </x-table-component>

@endsection
