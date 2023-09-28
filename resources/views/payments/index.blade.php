@extends('layouts.app')
@section('content')
    <payment-report uri="/payments" name="Pagos" :warehouses="{{ json_encode($inventories) }}" />
@endsection
