@extends('layouts.app')
@section('content')
    <sale-component 
        :sale="{{json_encode($sale)}}"
        :categories="{{$categories}}"
    >
    </sale-component>
@endsection