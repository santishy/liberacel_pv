@extends('layouts.app')
@section('content')
    <report-component :is-sale="true" name="Ventas" uri="/sales">
        <transtion-list name="Ventas" uri="/sales"></transtion-list>
    </report-component>
@endsection
