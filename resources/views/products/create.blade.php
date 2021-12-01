@extends('layouts.app')
@section('content')
        <product-form 
                method="post" 
                :categories="{{json_encode($categories)}}"
                :inventories="{{json_encode($inventories)}}"
        ></product-form>   
@endsection