@extends('layouts.app')

@section('content')
<x-table-component resource="users" :bannable="true" :actions="true" title="{{$title}}" :headings="$headings" :items="$items"/>

@endsection
