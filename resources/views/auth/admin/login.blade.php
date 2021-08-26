<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Admin Login - SMS Alerts PK</title>

    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    {{-- <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet"> --}}

    <link href="{{ asset('dist/css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/authentication.css') }}" rel="stylesheet">
    <style>
        .btn {
            border-radius: 10px !important;
        }

    </style>
</head>

<body>

    <div class="main-wrapper">
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">SMS Alerts PK</p>
            </div>
        </div>

        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url({{ asset('assets/images/big/auth-bg2.jpg') }}) no-repeat left center;">
            <div class="container">
                <div class="row">
                    <div class="col s12 l8 m6 demo-text">
                        <span class="db"><img class="responsive-img"
                                src="{{ asset('assets/images/icon-dark4x.png') }}" alt="logo" /></span>
                        <span class="db"><img class="responsive-img"
                                src="{{ asset('assets/images/text-dark4x.png') }}" alt="logo" /></span>
                        {{-- <h1 class="font-light m-t-40">Welcome to the <span class="font-medium black-text">SMS Alerts
                                PK</span></h1> --}}
                        <p class="m-t-40">This is just a demo text which you can change as per your requeirment, so
                            change once you
                            get
                            chance. this is default text.</p>
                        <a class="btn btn-round red m-t-5">Know more</a>
                    </div>
                </div>
                <div class="auth-box auth-sidebar">
                    <div id="loginform">
                        <div class="p-l-10">
                            <h5 class="font-medium m-b-0 m-t-40">Sign In to Account</h5>
                            <small>Just login to your account</small>
                        </div>
                        @if (Session::get('AlertType') && Session::get('AlertMsg'))
                            <div class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                                {{ Session::get('AlertMsg') }}
                            </div>
                        @endif

                        <!-- Form -->
                        <div class="row">
                            <form class="col s12" action="{{ route('r.login') }}" method="POST">
                                <!-- email -->
                                @csrf
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="email" class="form-label">Email address</label>
                                        <input type="email" name="email"
                                            class="validate @error('email') invalid @enderror" id="email"
                                            value="{{ old('email') }}">
                                        <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                    </div>
                                </div>
                                <!-- pwd -->
                                <div class="row">
                                    <div class="input-field col s12">
                                        <label for="password" class="form-label">Password</label>
                                        <input type="password" name="password"
                                            class="validate @error('password') invalid @enderror" id="password">
                                        <span class="text-danger">@error('password') {{ $message }}
                                            @enderror</span>
                                    </div>
                                </div>
                                <div class="row m-t-5">
                                    <div class="col s12">
                                        <button class="btn-large btn w100 blue accent-4" type="submit">Login</button>
                                    </div>
                                    <div class="col s12 center-align db m-t-10">
                                        Have an teacher account? <a
                                            href="{{ route('r.teacher-login-view') }}">Teacher Login</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/materialize.min.js') }}"></script>

    <script>
        $('.tooltipped').tooltip();
        $(function() {
            $(".preloader").fadeOut();
        });
    </script>
</body>

</html>
