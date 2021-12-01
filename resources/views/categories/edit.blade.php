@extends('layouts.app')
@section('content')
    <edit-category :category="{{json_encode($category)}}" method="put"></edit-category>
@endsection