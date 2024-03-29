<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }} - @yield('pageTitle', 'Page')</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Fira+Sans:400,500,700|Montserrat:300,400&display=swap" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body class="font-body font-light text-gray-500 bg-gray-100">
    <div id="app">
        @include('layouts.header')
        <div class="container mx-auto my-16">
            @if (session()->has('flashMessage'))
                <flash-message :message='@json(session()->get('flashMessage'))'></flash-message>
            @endif
            <main>
                @if(View::hasSection('overviewUrl') || View::hasSection('deleteLink'))
                    <div class="flex items-center mb-4">
                        <div class="flex-1">
                            @if(View::hasSection('overviewUrl'))
                                <a href="@yield('overviewUrl')"><i class="fas fa-caret-left"></i> @lang('general.backOverview')</a>
                            @endif
                        </div>
                        <div class="flex justify-end items-center">
                            @yield('deleteLink')
                        </div>
                    </div>
                @endif

                @yield('content')
            </main>
        </div>
    </div>
    <script> </script>
</body>
</html>
