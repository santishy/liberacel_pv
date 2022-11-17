@extends('layouts.app')
@section('content')
    <create-expense method="patch" :expense="{{json_encode($expense)}}">
    </create-expense>
@endsection
