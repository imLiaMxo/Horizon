<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <meta http-equiv="X-UA-Compatible" content="ie=edge" />
        <script src="https://cdn.tailwindcss.com"></script>
        <title>Nomads | ERROR</title>
    </head>
    <body>
        <div class="flex items-center justify-center w-screen h-screen bg-gradient-to-r from-gray-800 to-gray-900">
            <div class="px-40 py-20 bg-gray-800 rounded-md shadow-xl">
                <div class="flex flex-col items-center">
                    <h1 class="font-bold text-white text-9xl">Uh Oh!</h1>

                    <h6 class="mb-2 text-2xl font-bold text-center text-white md:text-3xl">Something just went <span class="text-red-500">tits up!</span></h6>

                    <p class="mb-8 text-center text-white md:text-lg">
                        Honestly, no idea as to why this is happening. Contact an administrator.
                    </p>

                    <a href="{{ route('home') }}" class="bg-red-500 hover:bg-red-600 text-white font-bold py-2 px-4 rounded inline-flex items-center">Go home</a>
                </div>
            </div>
        </div>
        <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
