@extends('layouts.app')
@section('content')
    <setting-component 
        :settings="{{json_encode($settings)}}" 
    />
@endsection