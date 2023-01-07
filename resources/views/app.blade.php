<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">

    <!-- Styles -->
    <link href="{{ asset('fonts/feather/feather.css') }}?v={{ md5(config('app.version'))  }}" rel="stylesheet">
    <link href="{{ mix('css/theme.css') }}?v={{ md5(config('app.version'))  }}" rel="stylesheet" type="text/css">
    <link href="{{ mix('css/app.css') }}?v={{ md5(config('app.version')) }}" rel="stylesheet" type="text/css">

    <!-- Scripts -->
    <script src="{{ mix('js/app.js') }}?v={{ md5(config('app.version')) }}" defer></script>

    @routes
</head>
<body>
@inertia
</body>
</html>
