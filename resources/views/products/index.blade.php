@extends('layouts.app')
@section('content')
    <products-index :categories="{{json_encode($categories)}}"/>
@endsection