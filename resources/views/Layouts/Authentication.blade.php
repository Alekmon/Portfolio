<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite('resources/css/app.css')
    <title>@yield('title')</title>
</head>
<body>

    <div class="min-h-screen py-40" style="background-image: linear-gradient(115deg, #9F7AEA, #FEE2FE)">
        <div class="container mx-auto">
            <div class="w-16 bg-gray-600 py-3 text-center text-white rounded-md">
                <a href="{{ route('main') }}" class="">Назад</a>
            </div>
            <div class="flex w-8/12 bg-white rounded-xl mx-auto shadow-lg overflow-hidden">
                @yield('content')
            </div>
        </div>
    </div>

</body>
</html>