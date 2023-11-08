@extends('layouts.app')
@section('content')
    {{-- <transaction-report uri="/sales">
    </transaction-report> --}}
    <report-component name="Ventas" uri="/sales">
        <transtion-list name="Ventas" uri="/sales"></transtion-list>
    </report-component>
@endsection
