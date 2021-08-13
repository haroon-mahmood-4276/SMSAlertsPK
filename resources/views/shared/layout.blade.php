<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>@yield('PageTitle') - SMS Alerts PK</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link
        href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&family=Open+Sans:wght@400;600;700&display=swap"
        rel="stylesheet">

    @yield('BeforeCommonCss')
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    @yield('AfterCommonCss')
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
        <div class="bar-long"></div>
        <button type="button" class="btn btn-floating btn-large" id="btn-back-to-top">
            <i class="material-icons">arrow_upward</i>
        </button>

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
    <script>
        $(document).ready(function() {
            var currY = $(window).scrollTop();
                var postHeight = $(document).height();
                var scrollHeight = $(window).height();
                var scrollPercent = (currY / (scrollHeight - postHeight)) * 100;
                $('.bar-long').width(Math.abs(scrollPercent) + "%");
        });
        $(function() {
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

            $(window).scroll(function() {
                var currY = $(window).scrollTop();
                var postHeight = $(document).height();
                var scrollHeight = $(window).height();
                var scrollPercent = (currY / (scrollHeight - postHeight)) * 100;
                $('.bar-long').width(Math.abs(scrollPercent) + "%");
            });
        });
    </script>
    <script>
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
</body>

</html>
