@extends('layouts.app')
@section('content')
    <report-component :is-sale="{{ json_encode($isSale) }}" uri="{{ $uri }}" name="{{ $name }}"
        :warehouses="{{ json_encode($inventories) }}">
        <transaction-list name="{{ $name }}" uri="{{ $uri }}"></transaction-list>
    </report-component>
@endsection
