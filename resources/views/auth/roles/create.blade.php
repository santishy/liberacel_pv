@extends('layouts.app')
@section('content')
    <role-component
        :roles="{{json_encode($roles)}}"
        :permissions="{{json_encode($permissions)}}"
    ></role-component>
@endsection