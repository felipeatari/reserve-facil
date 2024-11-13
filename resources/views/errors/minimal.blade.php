<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        @vite('resources/css/app.css')
        <link rel="shortcut icon" href="/images/icon.png" type="image/x-icon">
        <title>@yield('title')</title>
    </head>
    <body class="bg-gray-50 text-gray-700">
        <div class="w-full flex flex-col items-center">
            <img class="h-16 mt-20" src="{{ asset('images/logo.png') }}" alt="Logo RF">

            <div class="px-4 text-5xl mt-20 mb-20">
                @yield('code')

                @yield('message')
            </div>

            <a href="{{ url('/') }}" class="hover:underline">Voltar para a página inicial</a>
        </div>
    </body>
</html>
