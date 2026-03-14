@extends('layouts.app')
@section('content')
    <edit-raffle :raffle="{{ json_encode($raffle) }}" />
@endsection
