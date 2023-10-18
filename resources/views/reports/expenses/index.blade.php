@extends('layouts.app')
@section('content')
    <report-component name="Egresos">
        <expense-list uri="/expense-report" />
    </report-component>
@endsection
