<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login - SMS Alerts PK</title>

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
        <div class="preloader">
            <div class="loader">
                <div class="loader__figure"></div>
                <p class="loader__label">SMS Alerts PK</p>
            </div>
        </div>
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url({{ asset('assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box" style="border-radius: 10px;">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset('assets/images/icon-dark4x.png') }}"
                                style="transform: scale(0.5)" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Sign In to Portal</h5>
                    </div>
                    <!-- Form -->
                    <div class="row">
                        @if (Session::get('AlertType') && Session::get('AlertMsg'))
                            <div class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                                {{ Session::get('AlertMsg') }}
                            </div>
                        @endif
                        <form class="col s12" id="login_form" action="{{ route('r.login') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="email" class="form-label">Email address</label>
                                    <input type="email" name="email" class="validate @error('email') invalid @enderror"
                                        id="email" value="{{ old('email') }}">
                                    <span class="text-danger">@error('email') {{ $message }}
                                        @enderror</span>
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <label for="password" class="form-label">Password</label>
                                    <input type="password" name="password"
                                        class="validate @error('password') invalid @enderror" id="password">
                                    <span class="text-danger">@error('password') {{ $message }}
                                        @enderror</span>
                                </div>
                                <div>
                                    <input type="hidden" name="latitude" value="0" id="latitude">
                                    <input type="hidden" name="longitude" value="0" id="longitude">
                                    <input type="hidden" name="message" value="" id="message">
                                </div>
                            </div>

                            <div class="row m-t-10">
                                <div class="col s12">
                                    <button class="btn-large w100 btn blue accent-4 submit" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="center-align m-t-20 db">
                        {{-- Don't have an account? <a href="authentication-register1.html">Sign Up!</a> --}}
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

        $('.submit').on('click', function(e) {
            e.preventDefault();
            getLocation();
        });

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(setPosition, setError);
            }
        }

        function setPosition(position) {
            document.getElementById("latitude").value = parseFloat(position.coords.latitude);
            document.getElementById("longitude").value = parseFloat(position.coords.longitude);
            document.getElementById("message").value = 'SUCCESS';
            $("#login_form").submit();
        }

        function setError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    document.getElementById("message").value = "PERMISSION_DENIED";
                    break;
                case error.POSITION_UNAVAILABLE:
                    document.getElementById("message").value = "POSITION_UNAVAILABLE"
                    break;
                case error.TIMEOUT:
                    document.getElementById("message").value = "TIMEOUT"
                    break;
                case error.UNKNOWN_ERROR:
                    document.getElementById("message").value = "UNKNOWN_ERROR"
                    break;
            }
            document.getElementById("latitude").value = parseFloat(0);
            document.getElementById("longitude").value = parseFloat(0);
            $("#login_form").submit();
        }
    </script>
</body>

</html>
