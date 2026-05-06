@extends('layouts.app')
@section('content')
    <!--TODO --> 
    <select-inventory :inventories="{{json_encode($inventories)}}"/>
@endsection