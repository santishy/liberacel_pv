@extends('layouts.app')
@section('content')
    <transaction-report uri="{{ $uri }}" name="{{ $name }}" :warehouses="{{ json_encode($inventories) }}">
    </transaction-report>
@endsection
