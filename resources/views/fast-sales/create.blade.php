@extends('layouts.app')
@section('content')
    <create-fast-sale :sale="{{json_encode($sale)}}"></create-fast-sale>
@endsection