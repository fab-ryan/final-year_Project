<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">


    <title>ATTS - @yield('title')</title>
    <link rel="icon" href="{{ url('css/favicon.jpeg') }}">
    @include('partials.inc_top')


</head>
<body class="">

    @include('partials.top_menu')
    <div class="page-content">
        @include('partials.side_bar')

        @include('sweetalert::alert')

        <div class="content-wrapper mt-0">


            <div class="content">
                {{--Error Alert Area--}}
                @if($errors->any())
                    <div class="alert alert-danger border-0 alert-dismissible">
                        <button type="button" class="close" data-dismiss="alert"><span>&times;</span></button>

                            @foreach($errors->all() as $er)
                                <span><i class="icon-arrow-right5"></i> {{ $er }}</span> <br>
                            @endforeach

                    </div>
                @endif
                <div id="ajax-alert" style="display: none"></div>

                @yield('content')
            </div>


        </div>
    </div>

    @include('partials.inc_bottom')

    @yield('scripts')

</body>
</html>
