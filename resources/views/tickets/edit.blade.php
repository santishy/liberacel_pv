@extends('layouts.app')
@section('content')
    <ticket-form 
        :ticket="{{json_encode($ticket)}}">
    </ticket-form>
@endsection