@extends('layouts.app')
@section('content')
    {{-- <fast-sales-reports></fast-sales-reports> --}}

    <report-component name="Venta Expres" uri="/fast-sales">
        <list-of-products-sold class="mt-4"></list-of-products-sold>
    </report-component>
@endsection
