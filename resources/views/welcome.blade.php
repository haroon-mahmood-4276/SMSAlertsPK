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
    <link rel="icon" type="image/png" sizes="16x16" href="{{asset('welcome/assets/images/favicon.png')}}">
    <title>Materialart Template - The Ultimate Multipurpose admin template</title>
    <!-- Custom CSS -->
    <link href="{{ asset('welcome/assets/libs/owl.carousel/dist/assets/owl.carousel.min.css') }}" rel="stylesheet" type="text/css" />
    <link href="{{ asset('welcome/assets/libs/owl.carousel/dist/assets/owl.theme.default.min.css') }}" rel="stylesheet" type="text/css" />
    <!-- Custom CSS -->
    <link href="{{ asset('dist/css/style.min.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/landingpage.css') }}" rel="stylesheet">

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
                            <a href="#!" class="brand-logo sml-logo">
                                <img src="{{asset('assets/images/icon-light.png')}}" alt="logo" class="ml-auto">
                            </a>
                            <a href="#" data-target="mobile-demo" class="sidenav-trigger sml-icon"><i class="material-icons">menu</i></a>
                            <ul class="right hide-on-med-and-down">
                                <li><a href="#demos">Demos</a></li>
                                <li><a href="#apps">Apps</a></li>
                                <li><a href="../docs/documentation.html" target="_blank">Documentation</a></li>
                                <li>
                                    <a href="https://themeforest.net/item/materialart-powerful-material-admin-template/22511427?ref=Maruti" class="waves-effect waves-light btn danger-gradient white-text" target="_blank">Buy Now</a>
                                </li>
                            </ul>
                             <ul class="sidenav sml-font" id="mobile-demo">
                                <li><a href="#demos">Demos</a></li>
                                <li><a href="#apps">Apps</a></li>
                                <li><a href="../docs/documentation.html" target="_blank">Documentation</a></li>
                                <li>
                                    <a href="https://themeforest.net/item/materialart-powerful-material-admin-template/22511427?ref=Maruti" class="waves-effect waves-light btn danger-gradient white-text" target="_blank">Buy Now</a>
                                </li>
                            </ul>
                        </div>
                    </nav>
                </div>
                <!-- End Header -->
                <div class="container">
                    <div class="row d-flex header-banner align-items-center">
                        <div class="col l5">
                            <h2>Build your Dashboard and Application with <span class="blue-text"> Materialart </span> in Record Time!</h2>
                            <p class="m-t-40"><span class="font-bold">4 Dashboard Variations,</span> 1600+ Page Templates, Unlimited Color Schemes, <span class="font-bold">10+ Unique Demos,</span> 500+ UI Elements, 100+ Integrated Plugins, Google material base design & more...</p>
                            <div>
                                <a href="#demos" class="waves-effect waves-light btn blue accent-4 m-t-40 m-b-40 dm-btn">Explore Demos</a>
                                <a href="https://themeforest.net/item/materialart-powerful-material-admin-template/22511427?ref=Maruti" class="waves-effect waves-light btn indigo darken-1 m-t-40 m-b-40 m-l-10">Buy Now</a>
                            </div>
                            <img src="{{asset('welcome/assets/images/technology.png')}}" alt="logos"/>
                        </div>
                        <div class="col l6 right-align p-l-40">
                            <img class="img-shadow responsive-img" src="{{asset('welcome/assets/images/db.jpg')}}" alt="db">
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
            <!-- Demos part -->
            <!-- ============================================================== -->
            <section id="demos" class="demos spacer">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col m12 center-align">
                            <h2>Ready to use Demos for your project</h2>
                            <p class="m-t-20 message-center w75">Our Demos are awesomely designed and carefully crafted, which helps you to create your project in no-time. Check them out!
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/1.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="btn red live-btn" href="../html/ltr/index.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Neat & Clean</span>
                                <h4>Left Sidebar Demo</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/2.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/mini-sidebar/index2.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Modern & Trendy</span>
                                <h4>Mini Sidebar Demo</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/3.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/horizontal/index3.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Minimal & Clean</span>
                                <h4>Horizontal Boxed Demo</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/4.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/horizontal-fullwidth/index4.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Modern & Flawless</span>
                                <h4>Horizontal Full Width Demo</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/5.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/dark/index3.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Pure & Classic</span>
                                <h4>Dark Demo</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/6.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/light-sidebar/index2.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Simple & Classic</span>
                                <h4>Light Sidebar Demo</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/7.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/iconbar/index3.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Stunning Combination</span>
                                <h4>Iconbar Demo</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/8.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/boxed/index4.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Trendy & Perfect</span>
                                <h4>Boxed Demo</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/9.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/rtl/index.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Right To Left</span>
                                <h4>RTL Demo</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-light center-align p-t-30 p-r-30 p-l-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/10.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/overlay/index2.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Invisible Sidebar</span>
                                <h4>Overlay Demo</h4>
                            </div>
                        </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ============================================================== -->
            <!-- Apps part -->
            <!-- ============================================================== -->
            <section id="apps" class="spacer bg-light">
                <div class="container">
                    <div class="row d-flex justify-content-center">
                        <div class="col m12 center-align">
                            <h2>Ready to use Apps for your project</h2>
                            <p class="m-t-20 message-center w75">Our Apps are awesomely designed and carefully crafted, which helps you to create your project in no-time. Check them out!
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-white center-align p-t-30 p-l-30 p-r-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/email.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/ltr/inbox-email.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Awesome Design</span>
                                <h4>Email Application</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-white center-align p-t-30 p-l-30 p-r-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/taskboard.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/ltr/app-taskboard.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Easy To Use</span>
                                <h4>Taskboard Application</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-white center-align p-t-30 p-l-30 p-r-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/calendar.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/ltr/app-calendar.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Clean & Modern</span>
                                <h4>Calendar Application</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-white center-align p-t-30 p-l-30 p-r-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/chat.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/ltr/app-chats.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Ready To Use</span>
                                <h4>Chat Application</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-white center-align p-t-30 p-l-30 p-r-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/contact.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/ltr/ui-user-contacts.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Killer Listing</span>
                                <h4>Contact Application</h4>
                            </div>
                        </div>
                        <div class="col m6 m-t-40">
                            <div class="live-box bg-white center-align p-t-30 p-l-30 p-r-30">
                                <img class="shadow responsive-img" src="{{asset('welcome/assets/images/ticket.jpg')}}" alt="d4">
                                <div class="overlay">
                                    <a class="waves-effect waves-light btn red live-btn" href="../html/ltr/ticket-list.html" target="_blank">Live Preview</a>
                                </div>
                            </div>
                            <div class="m-t-30">
                                <span class="font-12 font-bold uppercase-text">Easier & Faster</span>
                                <h4>Ticket Application</h4>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ============================================================== -->
            <!-- Feature part -->
            <!-- ============================================================== -->
            <section id="feature1" class="feature1 spacer primary-gradient">
                <div class="container">
                     <div class="row align-items-center">
                        <div class="col l5">
                            <h2 class="white-text p-t-40">Why choose Materialart over other dashboard templates?</h2>
                            <p class="white-text op-5 m-t-40">The only admin dashboard template you would need for your <b>all next backend</b> and <b>application</b> projects. Go and Get it!</p>
                            <a href="https://themeforest.net/item/materialart-powerful-material-admin-template/22511427?ref=Maruti" class="waves-effect waves-light btn warning-gradient white-text btn-large m-t-40 m-b-40">Buy Now</a>
                        </div>
                        <div class="col l6 p-l-40">
                            <img class="responsive-img" src="{{asset('welcome/assets/images/code-db.png')}}" alt="cdb">
                        </div>
                    </div>
                    <div class="row">
                        <div class="col m4 m-t-20">
                            <img src="{{asset('welcome/assets/images/icon1.png')}}">
                            <h4 class="white-text m-t-30">Handcrafted Designs</h4>
                            <p class="white-text op-5 m-t-20">Our Designs are truly awesome and unique, which brings freshness to your project.</p>
                        </div>
                        <div class="col m4 m-t-20">
                            <img src="{{asset('welcome/assets/images/icon2.png')}}">
                            <h4 class="white-text m-t-30">Seamless Coding</h4>
                            <p class="white-text op-5 m-t-20">We have crafted our templates very carefully and our code is W3C validated.</p>
                        </div>
                        <div class="col m4 m-t-20">
                            <img src="{{asset('welcome/assets/images/icon3.png')}}">
                            <h4 class="white-text m-t-30">Dedicated Support</h4>
                            <p class="white-text op-5 m-t-20">We offer amazingly fast and professional support to our customers.</p>
                        </div>
                    </div>
                </div>
            </section>
            <!-- ============================================================== -->
            <!-- Feature part 2 -->
            <!-- ============================================================== -->
            <section id="feature2" class="feature2 spacer">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col m12 center-align">
                            <h2>Features which will Amaze you!</h2>
                            <p class="m-t-20 message-center w75">We know how important is for you to save time and create something stunning for your client, its easily possible with Materialart
                            </p>
                        </div>
                    </div>
                    <div class="row">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f1.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-20">6 Color Schemes</h5>
                            <p class="m-t-20">We have included 6 pre-defined color schemes with Materialart.</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f2.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-40">Colored / Dark / Light Sidebar</h5>
                            <p class="m-t-20">Options available to select suitable sidebar for your project</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f3.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-40">160+ Page Templates</h5>
                            <p class="m-t-20">Yes, we have added 160+ Pages template to make it easier.</p>
                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f4.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">300+ UI Components</h5>
                            <p class="m-t-20">You will get more than 300 unique UI Components</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f5.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Lots of Widgets</h5>
                            <p class="m-t-20">Widgets are important and we have included lots of them</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f16.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Gallery Options</h5>
                            <p class="m-t-20">Included gallery options for you to showcase products</p>
                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f7.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">2000+ Font Icons</h5>
                            <p class="m-t-20">Included more than 2000 Premium Font Icons</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f8.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Fully Responsive</h5>
                            <p class="m-t-20">Materialart is fully responsive with Material Design Framework</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f9.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Lots of Table Example</h5>
                            <p class="m-t-20">We made sure that you get lots of table options to choose</p>
                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f10.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Easy to Customize</h5>
                            <p class="m-t-20">Our Template is easy to do any required changes</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f11.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Lots of Chart Options</h5>
                            <p class="m-t-20">Included best possible chart options for your project</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f12.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Multiple File Uploads</h5>
                            <p class="m-t-20">Option to upload more than one file at one time</p>
                        </div>
                    </div>
                    <div class="row m-t-40">
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f13.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Validation Forms</h5>
                            <p class="m-t-20">We have included validation forms with Materialart</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f14.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">eCommerce Pages</h5>
                            <p class="m-t-20">If you are eCommerce company, you got covered</p>
                        </div>
                        <div class="col l4 m6 center-align m-t-40">
                            <span class="feature-image">
                                <img src="{{asset('welcome/assets/images/f15.jpg')}}" alt="f1">
                            </span>
                            <h5 class="m-t-30">Calendar Design</h5>
                            <p class="m-t-20">We have included Calendar application with Materialart</p>
                        </div>
                    </div>
                </div>
            </section>
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
                                    <img src="{{asset('welcome/assets/images/quote.png')}}" alt="quote" style="width: 50px;">
                                    <h4 class="m-t-30 m-b-30 quote">Very nice template. You get a really <b>big package</b> with examples for everything, so you are <b>ready to go if you want quickly build a nice looking app.</b> The support team is also fast and nice if you have any questions they answer it fast.</h4>
                                    <span class="blue-text">Mark Maurer</span>
                                </div>
                                <div class="item">
                                    <img src="{{asset('welcome/assets/images/quote.png')}}" alt="quote" style="width: 50px;">
                                    <h4 class="m-t-30 m-b-30 quote">Very nice template. You get a really <b>big package</b> with examples for everything, so you are <b>ready to go if you want quickly build a nice looking app.</b> The support team is also fast and nice if you have any questions they answer it fast.</h4>
                                    <span class="blue-text">Mark Maurer</span>
                                </div>
                                <div class="item">
                                    <img src="{{asset('welcome/assets/images/quote.png')}}" alt="quote" style="width: 50px;">
                                    <h4 class="m-t-30 m-b-30 quote">Very nice template. You get a really <b>big package</b> with examples for everything, so you are <b>ready to go if you want quickly build a nice looking app.</b> The support team is also fast and nice if you have any questions they answer it fast.</h4>
                                    <span class="blue-text">Mark Maurer</span>
                                </div>
                                <div class="item">
                                    <img src="{{asset('welcome/assets/images/quote.png')}}" alt="quote" style="width: 50px;">
                                    <h4 class="m-t-30 m-b-30 quote">Very nice template. You get a really <b>big package</b> with examples for everything, so you are <b>ready to go if you want quickly build a nice looking app.</b> The support team is also fast and nice if you have any questions they answer it fast.</h4>
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
            <footer class="center-align m-t-40 p-20 bg-light">All Rights Reserved by Materialart. Designed and Developed by <a href="https://wrappixel.com">WrapPixel</a>.</footer>
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
