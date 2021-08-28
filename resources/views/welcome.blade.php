<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <!-- Tell the browser to be responsive to screen width -->
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="description" content="">
    <meta name="author" content="">
    <!-- Favicon icon -->
    <link rel="icon" type="image/png" sizes="16x16" href="{{ asset('favicon.png') }}">
    <title>Home - SMS Alerts PK</title>
    <!-- Custom CSS -->
    <link href="{{ asset('welcome/assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet"
        type="text/css" />
    <link href="{{ asset('welcome/assets/libs/owl.carousel/dist/assets/owl.theme.default.min.css') }}"
        rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/landingpage.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/pricing-page.css') }}" rel="stylesheet">

</head>

<body class="bg-white">
    <!-- ============================================================== -->
    <!-- Main wrapper -->
    <!-- ============================================================== -->
    <div id="main-wrapper">
        <!-- ============================================================== -->
        <!-- Header part -->
        <!-- ============================================================== -->
        <header class="topbar">
            <!-- Start Header -->
            <div class="header">
                <nav class="sml-nav p-r-0">
                    <div class="nav-wrapper info-gradient">
                        <a href="{{ route('r.welcome') }}" class="brand-logo sml-logo">
                            <span class="icon">
                                <img class="light-logo" src="{{ asset('assets/images/icon-light.png') }}">
                                <img class="dark-logo" src="{{ asset('assets/images/icon-dark.png') }}">
                            </span>
                            <span class="text">
                                <img class="light-logo" src="{{ asset('assets/images/text-light.png') }}">
                                <img class="dark-logo" src="{{ asset('assets/images/text-dark.png') }}">
                            </span>
                        </a>
                        <ul class="right hide-on-med-and-down">
                            <li><a href="#why-us">Why Us</a></li>
                            <li><a href="#feature">Features</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li>
                                <a href="{{ route('r.login') }}"
                                    class="waves-effect waves-light btn danger-gradient white-text">Login</a>
                            </li>
                        </ul>
                        <a href="#" data-target="mobile-demo" class="sidenav-trigger sml-icon"><i
                                class="material-icons">menu</i></a>
                        <ul class="sidenav sml-font" id="mobile-demo">
                            <li><a href="#why-us">Why Us</a></li>
                            <li><a href="#feature">Features</a></li>
                            <li><a href="#pricing">Pricing</a></li>
                            <li>
                                <a href="{{ route('r.login') }}"
                                    class="waves-effect waves-light btn danger-gradient white-text">Login</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
            <!-- End Header -->
            <div class="container">
                <div class="row d-flex header-banner align-items-center">
                    <div class="col l5">
                        <h2>Build your Dashboard and Application with <span class="blue-text"> Materialart </span> in
                            Record Time!</h2>
                        <p class="m-t-40"><span class="font-bold">4 Dashboard Variations,</span> 1600+ Page Templates,
                            Unlimited Color Schemes, <span class="font-bold">10+ Unique Demos,</span> 500+ UI Elements,
                            100+ Integrated Plugins, Google material base design & more...</p>
                        <div>
                            <a href="#demos"
                                class="waves-effect waves-light btn blue accent-4 m-t-40 m-b-40 dm-btn">Explore
                                Demos</a>
                            <a href="https://themeforest.net/item/materialart-powerful-material-admin-template/22511427?ref=Maruti"
                                class="waves-effect waves-light btn indigo darken-1 m-t-40 m-b-40 m-l-10">Buy Now</a>
                        </div>
                        <img src="{{ asset('welcome/assets/images/technology.png') }}" alt="logos" />
                    </div>
                    <div class="col l6 right-align p-l-40">
                        <img class="img-shadow responsive-img"
                            src="{{ asset('welcome/assets/images/dashbord.png') }}" alt="db">
                    </div>
                </div>
            </div>
        </header>
        <!-- ============================================================== -->
        <!-- Header part -->
        <!-- ============================================================== -->

        <!-- ============================================================== -->
        <!-- Page wrapper part -->
        <!-- ============================================================== -->
        <div class="page-wrapper">
            <!-- ============================================================== -->
            <!-- Feature part -->
            <!-- ============================================================== -->
            <section id="why-us" class="feature1 spacer primary-gradient">
                <div class="container">
                    <div class="row align-items-center">
                        <div class="col l5">
                            <h2 class="white-text p-t-40">Why choose Materialart over other dashboard templates?</h2>
                            <p class="white-text op-5 m-t-40">The only admin dashboard template you would need for your
                                <b>all next backend</b> and <b>application</b> projects. Go and Get it!
                            </p>
                            <a href="https://themeforest.net/item/materialart-powerful-material-admin-template/22511427?ref=Maruti"
                                class="waves-effect waves-light btn warning-gradient white-text btn-large m-t-40 m-b-40">Buy
                                Now</a>
                        </div>
                        <div class="col l6 p-l-40">
                            <img class="responsive-img" src="{{ asset('welcome/assets/images/dashbord.png') }}"
                                alt="cdb">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m4 m-t-20">
                            <img src="{{ asset('welcome/assets/images/icon1.png') }}">
                            <h4 class="white-text m-t-30">Handcrafted Designs</h4>
                            <p class="white-text op-5 m-t-20">Our Designs are truly awesome and unique, which brings
                                freshness to your project.</p>
                        </div>
                        <div class="col m4 m-t-20">
                            <img src="{{ asset('welcome/assets/images/icon2.png') }}">
                            <h4 class="white-text m-t-30">Seamless Coding</h4>
                            <p class="white-text op-5 m-t-20">We have crafted our templates very carefully and our code
                                is W3C validated.</p>
                        </div>
                        <div class="col m4 m-t-20">
                            <img src="{{ asset('welcome/assets/images/icon3.png') }}">
                            <h4 class="white-text m-t-30">Dedicated Support</h4>
                            <p class="white-text op-5 m-t-20">We offer amazingly fast and professional support to our
                                customers.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ============================================================== -->
            <!-- Feature part 2 -->
            <!-- ============================================================== -->
            <section id="feature" class="feature2 spacer">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col m12 center-align">
                            <h2>Features which will Amaze you!</h2>
                            <p class="m-t-20 message-center w75">We know how important is for you to save time and
                                create something stunning for your client, its easily possible with Materialart
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f1.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-20">6 Color Schemes</h5>
                            <p class="m-t-20">We have included 6 pre-defined color schemes with Materialart.</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f2.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-40">Colored / Dark / Light Sidebar</h5>
                            <p class="m-t-20">Options available to select suitable sidebar for your project</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f3.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-40">160+ Page Templates</h5>
                            <p class="m-t-20">Yes, we have added 160+ Pages template to make it easier.</p>
                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f4.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">300+ UI Components</h5>
                            <p class="m-t-20">You will get more than 300 unique UI Components</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f5.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Lots of Widgets</h5>
                            <p class="m-t-20">Widgets are important and we have included lots of them</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f16.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Gallery Options</h5>
                            <p class="m-t-20">Included gallery options for you to showcase products</p>
                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f7.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">2000+ Font Icons</h5>
                            <p class="m-t-20">Included more than 2000 Premium Font Icons</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f8.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Fully Responsive</h5>
                            <p class="m-t-20">Materialart is fully responsive with Material Design Framework</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f9.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Lots of Table Example</h5>
                            <p class="m-t-20">We made sure that you get lots of table options to choose</p>
                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f10.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Easy to Customize</h5>
                            <p class="m-t-20">Our Template is easy to do any required changes</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f11.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Lots of Chart Options</h5>
                            <p class="m-t-20">Included best possible chart options for your project</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f12.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Multiple File Uploads</h5>
                            <p class="m-t-20">Option to upload more than one file at one time</p>
                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f13.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Validation Forms</h5>
                            <p class="m-t-20">We have included validation forms with Materialart</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f14.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">eCommerce Pages</h5>
                            <p class="m-t-20">If you are eCommerce company, you got covered</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{ asset('welcome/assets/images/f15.jpg') }}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Calendar Design</h5>
                            <p class="m-t-20">We have included Calendar application with Materialart</p>
                        </div>
                    </div>
                </div>
            </section>

            <div id="pricing" class="container-fluid">
                <div class="row">
                    <div class="col s12">
                        <div class="card">
                            <div class="card-content">
                                <div class="row justify-content-center">
                                    <div class="col m12 center-align">
                                        <h2>Pricing!</h2>
                                    </div>
                                </div>
                                <div class="row justify-content-center pricing-plan m-t-20">
                                    <div class="col s12 m6 l3 no-padding">
                                        <div class="pricing-box">
                                            <div class="pricing-body b-l">
                                                <div class="pricing-header">
                                                    <h5 class="center-align">Silver</h5>
                                                    <h2 class="center-align"><span class="price-sign">$</span>24</h2>
                                                    <p class="uppercase">per month</p>
                                                </div>
                                                <div class="price-table-content">
                                                    <div class="price-row"><i class="icon-user"></i> 3 Members</div>
                                                    <div class="price-row"><i class="icon-screen-smartphone"></i> Single
                                                        Device</div>
                                                    <div class="price-row"><i class="icon-drawar"></i> 50GB Storage
                                                    </div>
                                                    <div class="price-row"><i class="icon-refresh"></i> Monthly Backups
                                                    </div>
                                                    <div class="price-row">
                                                        <button class="btn waves-effect waves-light m-t-20">Sign
                                                            up</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 no-padding">
                                        <div class="pricing-box b-l">
                                            <div class="pricing-body">
                                                <div class="pricing-header">
                                                    <h5 class="center-align">Gold</h5>
                                                    <h2 class="center-align"><span class="price-sign">$</span>34</h2>
                                                    <p class="uppercase">per month</p>
                                                </div>
                                                <div class="price-table-content">
                                                    <div class="price-row"><i class="icon-user"></i> 5 Members</div>
                                                    <div class="price-row"><i class="icon-screen-smartphone"></i> Single
                                                        Device</div>
                                                    <div class="price-row"><i class="icon-drawar"></i> 80GB Storage
                                                    </div>
                                                    <div class="price-row"><i class="icon-refresh"></i> Monthly Backups
                                                    </div>
                                                    <div class="price-row">
                                                        <button class="btn waves-effect waves-light m-t-20">Sign
                                                            up</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 no-padding">
                                        <div class="pricing-box featured-plan">
                                            <div class="pricing-body">
                                                <div class="pricing-header">
                                                    <h6 class="price-lable yellow darken-4 white-text">Popular</h6>
                                                    <h5 class="center-align">Platinum</h5>
                                                    <h2 class="center-align"><span class="price-sign">$</span>45</h2>
                                                    <p class="uppercase">per month</p>
                                                </div>
                                                <div class="price-table-content">
                                                    <div class="price-row"><i class="icon-user"></i> 10 Members</div>
                                                    <div class="price-row"><i class="icon-screen-smartphone"></i> Single
                                                        Device</div>
                                                    <div class="price-row"><i class="icon-drawar"></i> 120GB Storage
                                                    </div>
                                                    <div class="price-row"><i class="icon-refresh"></i> Monthly Backups
                                                    </div>
                                                    <div class="price-row">
                                                        <button
                                                            class="btn btn-large red waves-effect waves-light m-t-20">Sign
                                                            up</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l3 no-padding">
                                        <div class="pricing-box">
                                            <div class="pricing-body b-r">
                                                <div class="pricing-header">
                                                    <h5 class="center-align">Dimond</h5>
                                                    <h2 class="center-align"><span class="price-sign">$</span>54</h2>
                                                    <p class="uppercase">per month</p>
                                                </div>
                                                <div class="price-table-content">
                                                    <div class="price-row"><i class="icon-user"></i> 15 Members</div>
                                                    <div class="price-row"><i class="icon-screen-smartphone"></i> Single
                                                        Device</div>
                                                    <div class="price-row"><i class="icon-drawar"></i> 1TB Storage</div>
                                                    <div class="price-row"><i class="icon-refresh"></i> Monthly Backups
                                                    </div>
                                                    <div class="price-row">
                                                        <button class="btn waves-effect waves-light m-t-20">Sign
                                                            up</button>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <!-- ============================================================== -->
            <!-- Testimonial part -->
            <!-- ==============================================================-->
            <section id="testimonial" class="testimonial spacer">
                <span class="aboveline"></span>
                <div class="container">
                    <div class="row m-t-40 m-b-40 justify-content-center">
                        <div class="col s12">
                            <div class="owl-carousel owl-theme center-align" id="testi">
                                <div class="item">
                                    <img src="{{ asset('welcome/assets/images/quote.png') }}" alt="quote"
                                        style="width: 50px;">
                                    <h4 class="m-t-30 m-b-30 quote">Very nice template. You get a really <b>big
                                            package</b> with examples for everything, so you are <b>ready to go if you
                                            want quickly build a nice looking app.</b> The support team is also fast and
                                        nice if you have any questions they answer it fast.</h4>
                                    <span class="blue-text">Mark Maurer</span>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('welcome/assets/images/quote.png') }}" alt="quote"
                                        style="width: 50px;">
                                    <h4 class="m-t-30 m-b-30 quote">Very nice template. You get a really <b>big
                                            package</b> with examples for everything, so you are <b>ready to go if you
                                            want quickly build a nice looking app.</b> The support team is also fast and
                                        nice if you have any questions they answer it fast.</h4>
                                    <span class="blue-text">Mark Maurer</span>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('welcome/assets/images/quote.png') }}" alt="quote"
                                        style="width: 50px;">
                                    <h4 class="m-t-30 m-b-30 quote">Very nice template. You get a really <b>big
                                            package</b> with examples for everything, so you are <b>ready to go if you
                                            want quickly build a nice looking app.</b> The support team is also fast and
                                        nice if you have any questions they answer it fast.</h4>
                                    <span class="blue-text">Mark Maurer</span>
                                </div>
                                <div class="item">
                                    <img src="{{ asset('welcome/assets/images/quote.png') }}" alt="quote"
                                        style="width: 50px;">
                                    <h4 class="m-t-30 m-b-30 quote">Very nice template. You get a really <b>big
                                            package</b> with examples for everything, so you are <b>ready to go if you
                                            want quickly build a nice looking app.</b> The support team is also fast and
                                        nice if you have any questions they answer it fast.</h4>
                                    <span class="blue-text">Mark Maurer</span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <span class="underline"></span>
            </section>
            <!-- ============================================================== -->
            <!-- Footer part -->
            <!-- ============================================================== -->
            <footer class="center-align p-b-30 m-t-20 p-t-30 bg-light" style="font-size: 15px"><i
                    class="far fa-copyright"></i> All Rights Reserved
                by <a href="https://iyetech.com/" target="_blank">IYETECH</a>. Designed and Developed by
                <span>&#10084;&#65039;</span> <a href="https://haroonmahmoods.web.app" target="_blank">Haroon
                    Mahmood</a>.
            </footer>

        </div>
        <!-- ============================================================== -->
        <!-- End page wrapperHeader part -->
        <!-- ============================================================== -->
    </div>
</body>
<!-- ============================================================== -->
<!-- All Jquery -->
<!-- ============================================================== -->
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/materialize.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('welcome/assets/libs/owl.carousel/dist/owl.carousel.min.js') }}"></script>
<script src="{{ asset('dist/js/custom.js') }}"></script>
<script src="{{ asset('welcome/assets/js/custom.js') }}"></script>

</html>
