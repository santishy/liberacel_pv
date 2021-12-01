@extends('layouts.app')
@section('content')
    <client-form 
        :client="{{$client}}" 
        method="put"  
    />
@endsection