<!DOCTYPE html>
<html>

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <title>@yield('title') - SMS Alerts PK</title>
    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
    <!-- This page CSS -->
    <link href="{{ asset('dist/css/pages/error-pages.css') }}" rel="stylesheet">

</head>

<body>
    <section id="wrapper" class="error-page">
        <div class="error-box">
            <div class="error-body center-align">
                <h1>@yield('code')</h1>
                <h3>@yield('message')</h3>
                <a href="{{ route('r.login') }}" class="btn btn-round red waves-effect waves-light m-t-40 m-b-40">Back to
                    home</a>
            </div>
        </div>
    </section>
    <!-- ============================================================== -->
    <!-- All Required js -->
    <!-- ============================================================== -->
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/materialize.min.js') }}"></script>
</body>

</html>
