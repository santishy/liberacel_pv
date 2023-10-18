@extends('layouts.app')
@section('content')
    <report-component name="Pagos">
        <payment-list uri="/payments"></payment-list>
    </report-component>
    {{-- <payment-report uri="/payments" name="Pagos" :warehouses="{{ json_encode($inventories) }}" /> --}}
@endsection
