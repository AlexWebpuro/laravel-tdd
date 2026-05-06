<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Welcome') }} - {{ config('app.name', 'Laravel') }}</title>

        <link rel="icon" href="/favicon.ico" sizes="any">
        <link rel="icon" href="/favicon.svg" type="image/svg+xml">
        <link rel="apple-touch-icon" href="/apple-touch-icon.png">

        <!-- Fonts -->
        <!-- <link rel="preconnect" href="https://fonts.bunny.net"> -->
        <!-- <link href="https://fonts.bunny.net/css?family=instrument-sans:400,500,600" rel="stylesheet" /> -->

        <!-- <link rel="stylesheet" href="{{ asset('css/app.css') }}">  -->
        @vite(['resources/css/app.css', 'resources/js/app.js'])

    </head>
    <body class="bg-gray-200">
        <ul class="max-w-lg bg-white border-r border-gray-300 shadow-xl">
            @foreach ($repositories as $repository )
            <li class="flex items-center text-black p-2 hover:gb-gray-300">
                <img 
                    src="{{ $repository->user->profile_photo_path }}" 
                    class="w-12 h-12 rounded-full mr-2" alt="">
                <div class="flex justify-between w-full">
                    <div class="flex-1 ">
                        <h2 class="text-sm font-semibold text-black">{{ $repository->url }}</h2>
                        <p class="">{{ $repository->description }}</p>
                    </div>
                    <span class="text-xs font-medium text-gray-600">
                        {{ $repository->created_at->diffForHumans() }}
                    </span>
                </div>
            </li>
            @endforeach
        </ul>
    </body>
</html>
