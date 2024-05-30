@extends('layouts.app')
@section('content')
    <product-form title="Editar producto" :product="{{ $product }}" method="put" 
        :categories="{{ json_encode($categories) }}" />
@endsection
