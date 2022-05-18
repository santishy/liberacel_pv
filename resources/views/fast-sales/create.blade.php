@extends('layouts.app')
@section('content')
    <create-fast-sale 
        :product-bonuses="{{ json_encode($productBonuses) }}" 
        :sale="{{ !is_null($sale) ?  Illuminate\Support\Js::from($sale) : '' }}"
    >
    </create-fast-sale>
@endsection
