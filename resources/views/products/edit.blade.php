@extends('layouts.app')
@section('content')
    <product-form 
        :product="{{$product}}" 
        method="put"
        class="mt-4"
        :categories="{{json_encode($categories)}}"
    />

@endsection