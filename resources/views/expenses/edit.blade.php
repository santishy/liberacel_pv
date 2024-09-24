@extends('layouts.app')
@section('content')
    <create-expense method="PATCH" :expense="{{ json_encode($expense) }}">
    </create-expense>
@endsection
