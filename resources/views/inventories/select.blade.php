@extends('layouts.app')
@section('content')
    <!--TODO --> 
    <select-inventory :inventories="@json($inventories)"/>
@endsection