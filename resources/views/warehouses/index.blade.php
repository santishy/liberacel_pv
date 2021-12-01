@extends('layouts.app')
@section('content')

    <warehouse-list :inventories="{{json_encode($inventories)}}"></warehouse-list>
@endsection