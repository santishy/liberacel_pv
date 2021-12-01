@extends('layouts.app')
@section('content')

    <register 
        :editable-user="{{json_encode($user)}}"
        :roles="{{json_encode($roles)}}"
        :has-roles="{{json_encode($user->roles)}}"
        :inventories="{{json_encode($inventories)}}"
        uri="/users/{{$user->id}}"
        method="put"
    >
    </register>

@endsection