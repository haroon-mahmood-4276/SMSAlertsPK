<!DOCTYPE html>
<html>

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Teacher Login - SMS Alerts PK</title>

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
        <!-- ============================================================== -->
        <!-- Preloader - style you can find in spinners.css -->
        <!-- ============================================================== -->
        <!-- ============================================================== -->
        <!-- Login box.scss -->
        <!-- ============================================================== -->
        <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
            style="background:url({{ asset('assets/images/big/auth-bg.jpg') }}) no-repeat center center;">
            <div class="auth-box">
                <div id="loginform">
                    <div class="logo">
                        <span class="db"><img src="{{ asset('assets/images/icon-dark.png') }}" alt="logo" /></span>
                        <h5 class="font-medium m-b-20">Sign In to Teacher</h5>
                    </div>
                    @if (Session::get('AlertType') && Session::get('AlertMsg'))
                        <div class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                            {{ Session::get('AlertMsg') }}
                        </div>
                    @endif
                    <!-- Form -->
                    <div class="row">
                        <form class="col s12" action="{{ route('r.teacher-login') }}" method="POST">
                            @csrf
                            <!-- email -->
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="email" type="email" name="email"
                                        class="validate @error('email') invalid @enderror" value="{{ old('email') }}"
                                        required>
                                    <label for="email">Email</label>
                                    <span class="text-danger">@error('email') {{ $message }} @enderror</span>
                                </div>
                            </div>
                            <!-- pwd -->
                            <div class="row">
                                <div class="input-field col s12">
                                    <input id="password" type="password" name="password"
                                        class="validate @error('password') invalid @enderror" required>
                                    <label for="password">Password</label>
                                    <span class="text-danger">@error('password') {{ $message }}
                                        @enderror</span>
                                </div>
                            </div>
                            <!-- pwd -->
                            {{-- <div class="row m-t-5">
                                <div class="col s12 right-align"><a href="#" class="link" id="to-recover">Forgot Password?</a>
                                </div>
                            </div> --}}
                            <!-- pwd -->
                            <div class="row m-t-20">
                                <div class="col s12">
                                    {{-- <button class="btn waves-effect waves-light" type="submit" name="action">Login
                                        <i class="material-icons right">send</i>
                                    </button> --}}
                                    <button class="btn-large w100 btn blue accent-4" type="submit">Login</button>
                                </div>
                            </div>
                        </form>
                    </div>
                    <div class="col s12 center-align m-t-10 db">
                        Have an admin account? <a href="{{ route('r.login') }}">Admin Login</a>
                    </div>
                </div>
            </div>
        </div>
    </div>

    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/materialize.min.js') }}"></script>
    <script>
        $(function() {
            $(".preloader").fadeOut();
        });
    </script>
</body>

</html>
