<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>@yield('PageTitle') - SMS Alerts PK</title>

        <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png')}}">
        {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}

        @yield('BeforeCommonCss')
        <link href="{{ asset('dist/css/style.css')}}" rel="stylesheet">
        {{-- <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet"> --}}
        @yield('AfterCommonCss')

    </head>

    <body>
        <div class="main-wrapper" id="main-wrapper">
            <div class="preloader">
                <div class="loader">
                    <div class="loader__figure"></div>
                    <p class="loader__label">SMS Alerts PK</p>
                </div>
            </div>

            <div>
                {{ View::make('shared.header') }}
            </div>

            <div>
                {{ View::make('shared.leftsidebar') }}
            </div>

            <div>
                @yield('content')
            </div>

            <div>
                {{ View::make('shared.footer') }}
            </div>

            <div>
                {{ View::make('shared.rightsidebar') }}
            </div>

        </div>

        @yield('Js')

    </body>

</html>
