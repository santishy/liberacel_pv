@extends('layouts.app')
@section('content')
<create-fast-sale :product-bonuses="{{ json_encode($productBonuses) }}" :hasActiveRaffle="{{ json_encode($hasActiveRaffle) }}"
    @if(isset($sale))
    :sale="{{ json_encode($sale)}}"
    @endif>
</create-fast-sale>

@endsection
