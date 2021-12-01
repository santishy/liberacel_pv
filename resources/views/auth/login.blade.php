<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="{{asset('css/app.css')}}">
    <title>Login</title>
</head>
<body class="bg-gray-200 h-screen">
    <div class="container mx-auto mt-auto h-full flex justify-center content-center flex-wrap">
        <div class="flex justify-center w-full">
            <div class="md:w-1/3 w-full bg-gray-200 rounded">
                <div class="w-full flex justify-center">
                  <img class="w-1/3 h-auto" src="{{asset('images/logo.png')}}" alt="">
                </div>
                <h3 class="text-xl font-bold mb-0 mt-0  px-8 pt-2 text-center ">Ingresar al sistema</h3>
                  <form method="POST" action="{{route('login')}}" class=" px-8 pt-0 pb-8 mb-4">
                  @csrf
                  <div class="mb-0 px-2">
                    <input name="email" class="border-2 placeholder-gray-600 bg-gray-100  rounded relative rounded-bl-none rounded-br-none appearance-none  w-full py-3 px-3 text-gray-700 leading-tight focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10" id="username" type="email" placeholder="Email...">
                  </div>
                  <div class="mb-0 px-2">
                    <input name="password" class="border-2 placeholder-gray-600 bg-gray-100 relative appearance-none rounded rounded-tl-none rounded-tr-none w-full py-3 px-3 text-gray-700  leading-tight focus:outline-none focus:ring-indigo-500 focus:border-indigo-500 focus:z-10 " id="password" type="password" placeholder="Contraseña...">
                  </div>
                  <div class="flex items-center justify-between mt-6">
                    <button class="  w-full bg-blue-500 hover:bg-blue-400 text-white font-bold py-3 px-4 border-b-4 border-blue-700 hover:border-blue-500 rounded">
                      Ingresar
                    </button>
                  </div>
                </form>
              </div>
        </div>
    </div>
</body>
</html>