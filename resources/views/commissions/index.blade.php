@extends('layouts.app')
@section('content')
    <commissions-index :users="{{ json_encode($users) }}"></commissions-index>
@endsection