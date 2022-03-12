<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>
    @include('partials.inc_top')

</head>
<body>
    <div class="container-fluid">
        <div class="row">

        <main class="py-4">
            @yield('content')
        </main>
        </div>
    </div>
        @yield('script')
</body>
</html>
