<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Login</title>
</head>
<body class="bg-white h-screen ">
    <div class="container mx-auto mt-auto h-full flex md:justify-center  items-center content-center flex-wrap">
        <div class="flex md:justify-center w-full ">
            <div class="md:w-4/12 w-full  logo  py-4 px-2 rounded-2xl">
                <h3 class="text-xl font-bold  mt-0  px-8 pt-2 text-center mb-4 opacity-90 ">LOGIN</h3>
                  <form method="POST" action="{{route('login')}}" class=" px-8 pt-0 pb-8 mb-4 ">
                  @csrf
                  <div class="mb-0 ">
                    <input name="username" class="border-2  placeholder-gray-800 bg-gray-400 opacity-90  rounded relative rounded-bl-none rounded-br-none appearance-none  w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10" id="username" type="text" placeholder="Nombre de usuario...">
                    @error('username')
                      <div class="alert alert-danger">{{ $message }}</div>
                    @enderror
                  </div>
                  <div class="mb-0 ">
                    <input name="password" class="border-2  placeholder-gray-800 bg-gray-400 opacity-90 relative appearance-none rounded rounded-tl-none rounded-tr-none w-full py-3 px-3 text-gray-700  leading-tight focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 " id="password" type="password" placeholder="Contraseña...">
                  </div>
                  <div class="flex items-center justify-between my-2">
                    <button class=" opacity-90 hover:opacity-100  w-full bg-blue-200 hover:bg-blue-500 text-black font-bold py-3 px-4 border-b-4 border-blue-700 hover:border-blue-700 rounded">
                      Ingresar
                    </button>
                  </div>
                </form>
              </div>
        </div>
    </div>
</body>
</html>