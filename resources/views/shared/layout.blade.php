<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <meta name="_token" content="{{ csrf_token() }}" />
    <title>@yield('PageTitle') - SMS Alerts PK</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    <link href="{{ asset('assets/extra-libs/prism/prism.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
    <link href="{{ asset('assets/libs/footable/css/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">

    @yield('CSS')

    <style>
        html {
            scroll-behavior: smooth;
        }

        #btn-back-to-top {
            position: fixed;
            bottom: 80px;
            right: 20px;
            display: none;
            border-radius: 50% !important;
        }

        .bar-long {
            height: 5px;
            background-color: #6b00b5;
            width: 0px;
            z-index: 1000;
            position: fixed;
            top: 0;
            left: 0;
        }

    </style>
</head>

<body>
    <div class="main-wrapper" id="main-wrapper">

        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">SMS Alerts PK</p>
            </div>
        </div>

        <!-- Back to top button -->
        {{-- <div class="bar-long"></div> --}}
        <div class="loading-bar" id="loading-bar"></div>
        <button type="button" style="z-index: 99" class="btn btn-floating btn-large" id="btn-back-to-top">
            <i class="material-icons">arrow_upward</i>
        </button>

        <div>
            {{ View::make('components.header') }}
        </div>

        <div>
            {{ View::make('components.leftsidebar') }}
        </div>

        <div>
            @yield('content')
        </div>

        <div>
            {{ View::make('components.footer') }}
        </div>

        <div>
            {{ View::make('components.rightsidebar') }}
        </div>

    </div>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/materialize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>

    {{-- <script src="{{asset('assets/extra-libs/prism/prism.js')}}"></script> --}}
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script
        src="{{ asset('assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js') }}">
    </script>

    <script src="{{ asset('dist/js/sweetalert2.min.js') }}"></script>
    <script src="{{ asset('dist/js/jqueryvalidation.min.js') }}"></script>
    <script src="{{ asset('dist/js/jqueryadditionalvalidation.min.js') }}"></script>
    <script src="{{ asset('dist/js/nanobar.min.js') }}"></script>
    <script>
        var nanobar = new Nanobar({
            classname: 'loading-bar',
            id: 'loading-bar'
        });
        nanobar.go(30);

        $(function() {

            // resizeTopBar();
            nanobar.go(100);


            "use strict";
            $("#main-wrapper").AdminSettings({
                Theme: false, // this can be true or false ( true means dark and false means light ),
                Layout: 'vertical',
                LogoBg: 'skin5', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
                NavbarBg: 'skin5', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
                SidebarType: 'full', // You can change it full / mini-sidebar / iconbar / overlay
                SidebarColor: 'skin5', // You can change the Value to be skin1/skin2/skin3/skin4/skin5/skin6
                SidebarPosition: true, // it can be true / false ( true means Fixed and false means absolute )
                HeaderPosition: false, // it can be true / false ( true means Fixed and false means absolute )
                BoxedLayout: false, // it can be true / false ( true means Boxed and false means Fluid )
            });

            // $(window).scroll(function() {
            //     resizeTopBar();
            // });
        });


        // function resizeTopBar() {
        //     var currY = $(window).scrollTop();
        //     var postHeight = $(document).height();
        //     var scrollHeight = $(window).height();
        //     var scrollPercent = (currY / (scrollHeight - postHeight)) * 100;
        //     $('.bar-long').width(Math.abs(scrollPercent) + "%");
        // }

        let mybutton = document.getElementById("btn-back-to-top");

        window.onscroll = function() {
            if (document.documentElement.scrollTop > 200) {
                mybutton.style.display = "block";
            } else {
                mybutton.style.display = "none";
            }
        };

        mybutton.addEventListener("click", function backToTop() {
            document.documentElement.scrollTop = 0;
        });
    </script>
    @yield('Js')

</body>

</html>
