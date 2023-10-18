@extends('layouts.app')
@section('content')
    {{-- <transaction-report uri="/sales">
    </transaction-report> --}}
    <report-component name="Ventas" uri="/sales">
        <h1>Hola mundo</h1>
        <transtion-list name="Ventas" uri="/sales"></transtion-list>
    </report-component>
@endsection
