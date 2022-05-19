@extends('layouts.app')
@section('content')
    <create-fast-sale :product-bonuses="{{ json_encode($productBonuses) }}"
        @if(isset($sale))
            :sale="{{ json_encode($sale)}}"
        @endif
    >
    </create-fast-sale>
@endsection
