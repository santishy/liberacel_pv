<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="purchase_id" content="{{ session()->get('purchase_id') }}">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <meta name="current_user" content="{{ json_encode( CurrentUser::show()) }}">
    <meta name="impersonation_id" content="{{session('impersonation_id')}}">
    <title>Franapp</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Roboto&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('css/app.css')}}"> 

</head>
<body class="bg-gray-200 h-screen">
    <div id="app">
    {{-- <nav-component></nav-component> --}}
            @yield('content')
    </div>
    <script src="{{asset('js/app.js')}}"></script>
</body>
</html>