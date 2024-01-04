@extends('layouts.app')
@section('content')
    <product-form title="Editar producto" :product="{{ $product }}" method="put" class="mt-4"
        :categories="{{ json_encode($categories) }}" />
@endsection
