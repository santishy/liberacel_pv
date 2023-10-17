@extends('layouts.app')
@section('content')
    {{-- <expense-report name="Egresos" /> --}}
    <report-component name="Egresos">
        <expense-list uri="/expense-report" />
    </report-component>
@endsection
