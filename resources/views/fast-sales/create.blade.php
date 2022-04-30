@extends('layouts.app')
@section('content')
    <create-fast-sale :product-bonuses="{{ json_encode($productBonuses) }}" :sale="{{ json_encode($sale) }}">
    </create-fast-sale>
@endsection
