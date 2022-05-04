@extends('layouts.app')
@section('content')
<div class="d-flex justify-content-center mb-4 pt-4">

    <a href="{{ route('show.gymForm') }}" class="btn btn-primary">Add Gym</a>
</div>
    <x-table-component  :actions="true" title="{{$title}}" :headings="$headings" >
          @foreach($gyms as $gym)
              <tr>
                <td>{{ $gym->name }}</td>
                <td><img src="{{ asset($gym->cover_image) }}" style="width:100px;height:100px;" alt="gym cover image"/></td>
                <td>{{ $gym->city->name}}</td>

                  <td class="d-flex align-items-center">
                      <a href="{{ route('show.singleGym',['gymId'=>$gym['id']]) }}" class="btn btn-info"><i class="fa fa-eye"></i></a>
                      <a href="{{ route('edit.gymForm',['gymId'=>$gym['id']]) }}" class="btn btn-warning mx-2"><i class="fa fa-edit"></i></a>
                      <a href="{{ route('delete.gym',['gymId'=>$gym['id'] ]) }}" class="btn btn-danger delete-btn" data-toggle="modal" data-target="#delete-modal"><i class="fa fa-times"></i></a>
                  </td>
              </tr>
          @endforeach
      </x-table-component>

@endsection
