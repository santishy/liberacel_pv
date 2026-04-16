@extends('layouts.app')
@section('content')
    <sale-component 
        :sale="{{json_encode($sale)}}"
        :categories="{{$categories}}"
        :active-raffle="{{$activeRaffle ? 'true' : 'false'}}"
    >
    </sale-component>
@endsection