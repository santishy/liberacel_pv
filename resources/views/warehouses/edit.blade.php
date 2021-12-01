@extends('layouts.app')
@section('content')
    <edit-warehouse :inventory="{{json_encode($inventory)}}"></edit-warehouse>
@endsection