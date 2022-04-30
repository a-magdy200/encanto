@extends('layouts.app')

@section('content')
<div class="text-center">
  <a href="{{ route('orders.create') }}" class="mt-4 btn btn-success">Create </a>
</div><br>
<x-table-component resource="users" :bannable="true" :actions="true" title="{{$title}}" :headings="$headings" :items="$items"/>

@endsection
