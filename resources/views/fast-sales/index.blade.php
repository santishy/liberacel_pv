@extends('layouts.app')
@section('content')
    <report-component :is-sale="true" name="Venta Expres" uri="/fast-sales">
        <list-of-products-sold class="mt-4"></list-of-products-sold>
    </report-component>
@endsection
