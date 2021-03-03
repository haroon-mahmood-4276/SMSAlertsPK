<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('PageTitle') - SMS4Everyone</title>
        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        
        @yield('BeforeCommonCss')
        <link href="{{ asset('dist/css/style.css')}}" rel="stylesheet">
        @yield('AfterCommonCss')

    </head>

    <body>
        <div class="main-wrapper" id="main-wrapper">
            <div class="preloader">
                <div class="loader">
                    <div class="loader__figure"></div>
                    <p class="loader__label">SMS 4 Every</p>
                </div>
            </div>

            <div>
                {{ View::make('shared.header') }}
            </div>

            <div>
                {{ View::make('shared.sidebar') }}
            </div>

            <div>
                @yield('content')
            </div>

            {{ View::make('shared.footer') }}


            @yield('BeforeCommonJs')
            <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
            <script src="{{ asset('dist/js/materialize.min.js')}}"></script>
            <script src="{{ asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
            <script src="{{ asset('dist/js/app.js')}}"></script>
            <script src="{{ asset('dist/js/app.init.js')}}"></script>
            <script src="{{ asset('dist/js/app-style-switcher.js')}}"></script>
            <script src="{{ asset('dist/js/custom.min.js')}}"></script>
            @yield('AfterCommonJs')
        </div>

    </body>

</html>