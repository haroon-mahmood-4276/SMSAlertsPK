<!DOCTYPE html>
<html lang="en">

    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <meta http-equiv="X-UA-Compatible" content="ie=edge">
        <title>Login - SMS4Everyone</title>

        <link href="https://fonts.googleapis.com/css2?family=Nunito:wght@400;600;700&display=swap" rel="stylesheet">
        <link rel="shortcut icon" href="{{ asset('favicon.ico') }}" type="image/x-icon">
        <link rel="stylesheet" href="{{ asset('css/app.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/authentication.css') }}">
        <link rel="stylesheet" href="{{ asset('css/alert/sweetalert2.min.css') }}">

    </head>

    <body>

        <div class="main-wrapper">
            <!-- ============================================================== -->
            <!-- Preloader - style you can find in spinners.css -->
            <!-- ============================================================== -->
            <div class="preloader">
                <div class="loader">
                    <div class="loader__figure"></div>
                    <p class="loader__label">SMS 4 Everyone</p>
                </div>
            </div>

            <div class="auth-wrapper d-flex no-block justify-content-center align-items-center"
                style="background:url({{ asset('images/auth/auth-bg2.jpg') }}) no-repeat left center;">
                <div class="container">
                    <div class="row">
                        <div class="col s12 l8 m6 demo-text">
                            <span class="db"><img src="{{ asset('images/logo/logo-icon.png') }}" alt="logo" /></span>
                            <span class="db"><img src="{{ asset('images/logo/logo-text.png') }}" alt="logo" /></span>
                            <h1 class="font-light m-t-40">Welcome to the <span class="font-medium black-text">SMS 4
                                    Everyone Login</span></h1>
                            <p>This is just a demo text which you can change as per your requeirment, so change once you
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
                            <!-- Form -->
                            <div class="row">
                                <form class="col s12" action="{{route('r.login')}}" method="POST">
                                    <!-- email -->
                                    @csrf
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label for="email" class="form-label">Email address</label>
                                            <input type="email" name="email"
                                                class="validate @error('email') invalid @enderror" id="email"
                                                value="{{old('email')}}">
                                            <span class="text-danger">@error('email') {{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <!-- pwd -->
                                    <div class="row">
                                        <div class="input-field col s12">
                                            <label for="password" class="form-label">Password</label>
                                            <input type="password" name="password"
                                                class="validate @error('password') invalid @enderror" id="password">
                                            <span class="text-danger">@error('password') {{$message}} @enderror</span>
                                        </div>
                                    </div>
                                    <div class="row m-t-5">
                                        <div class="col s12">
                                            <button class="btn-large w100 blue accent-4" type="submit">Login</button>
                                        </div>
                                    </div>
                                    <div class="row m-t-15">
                                        <div class="col s12">
                                            <a href="#" class="link" id="sa-success">Forgot Password?</a>
                                        </div>
                                    </div>
                                    <div class="row">
                                        <div class="col s12 m6 l3">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h5 class="card-title">Success Message <small>(Click on image)</small></h5>
                                                    <img src="{{ asset('images/alert/alert3.png') }}" alt="alert" class="responsive-img model_img"
                                                        id="sa-success">
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col s12 m6 l3">
                                            <div class="card">
                                                <div class="card-content">
                                                    <h5 class="card-title">Warning Message <small>(Click on image)</small></h5>
                                                    <img src="{{ asset('images/alert/alert4.png') }}" alt="alert" class="responsive-img model_img"
                                                        id="sa-warning">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>

        {{-- Corejs --}}
        <script src="{{ asset('js/jquery.min.js') }}"></script>
        <script src="{{ asset('js/materialize.min.js') }}"></script>

        {{-- Alertjs --}}
        <script src="{{ asset('js/alert/sweetalert2.min.js') }}"></script>
        <script src="{{ asset('js/alert/sweet-alert.init.js') }}"></script>
        <script>
            $('.tooltipped').tooltip();

            $(function() {
                $(".preloader").fadeOut();
            });
        </script>
    </body>

</html>