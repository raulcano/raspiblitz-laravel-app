<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">

        <title>{{ __('Main menu')}}</title>

        <!-- Fonts -->
        <link rel="stylesheet" href="//fonts.googleapis.com/css?family=Nunito:400,500,700,400italic|Material+Icons">

        <!-- Styles -->
        <link href=" {{ asset('css/app.css') }}" rel="stylesheet">

        <style>
            body {
                font-family: 'Nunito';
            }
        </style>
    </head>
    <body class="antialiased">
    @yield('content')
    <script src="{{ asset('js/app.js') }}"></script>
    </body>
</html>
