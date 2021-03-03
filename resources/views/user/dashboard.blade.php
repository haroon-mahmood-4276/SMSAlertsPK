@extends('shared.layout')

@section('PageTitle', 'Dashboard')

@section('BeforeCommonCss')
<link href="{{ asset('assets/libs/chartist/dist/chartist.min.css')}}" rel="stylesheet">
<link href="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.css')}}" rel="stylesheet">
<link href="{{ asset('assets/extra-libs/c3/c3.min.css')}}" rel="stylesheet">
@endsection

@section('AfterCommonCss')
<link href="{{ asset('dist/css/pages/dashboard1.css')}}" rel="stylesheet">
@endsection

@section('content')


<!-- ============================================================== -->
<!-- Sidebar scss in sidebar.scss -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Page wrapper scss in scafholding.scss -->
<!-- ============================================================== -->
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Title and breadcrumb -->
    <!-- ============================================================== -->

    <!-- ============================================================== -->
    <!-- Container fluid scss in scafholding.scss -->
    <!-- ============================================================== -->
    <div class="container-fluid">
        <!-- ============================================================== -->
        <!-- Sales Summery -->
        <!-- ============================================================== -->
        <div class="row">
            <div class="col l3 m6 s12">
                <div class="card danger-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">250</h2>
                                <h6 class="white-text op-5 light-blue-text">Invoices</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">assignment</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l3 m6 s12">
                <div class="card info-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">520</h2>
                                <h6 class="white-text op-5">News Feed</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">receipt</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col l3 m6 s12">
                <div class="card success-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">100</h2>
                                <h6 class="white-text op-5 text-darken-2">Sales</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l3 m6 s12">
                <div class="card warning-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">450</h2>
                                <h6 class="white-text op-5">Revenue</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">attach_money</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l3 m6 s12">
                <div class="card danger-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">250</h2>
                                <h6 class="white-text op-5 light-blue-text">Invoices</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">assignment</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col l3 m6 s12">
                <div class="card info-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">520</h2>
                                <h6 class="white-text op-5">News Feed</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">receipt</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>


            <div class="col l3 m6 s12">
                <div class="card success-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">100</h2>
                                <h6 class="white-text op-5 text-darken-2">Sales</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">equalizer</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="col l3 m6 s12">
                <div class="card warning-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">450</h2>
                                <h6 class="white-text op-5">Revenue</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">attach_money</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- ============================================================== -->
    <!-- Container fluid scss in scafholding.scss -->
    <!-- ============================================================== -->

</div>
<!-- ============================================================== -->
<!-- Page wrapper scss in scafholding.scss -->
<!-- ============================================================== -->
<!-- ============================================================== -->
<!-- Right Sidebar -->
<!-- ============================================================== -->
<a href="#" data-target="right-slide-out"
    class="sidenav-trigger right-side-toggle btn-floating btn-large waves-effect waves-light red"><i
        class="material-icons">settings</i></a>
<aside class="right-sidebar">
    <!-- Right Sidebar -->
    <ul id="right-slide-out" class="sidenav right-sidenav p-t-10">
        <li>
            <div class="row">
                <div class="col s12">
                    <!-- Tabs -->
                    <ul class="tabs">
                        <li class="tab col s4"><a href="#settings" class="active"><span
                                    class="material-icons">build</span></a></li>
                        <li class="tab col s4"><a href="#chat"><span class="material-icons">chat_bubble</span></a></li>
                        <li class="tab col s4"><a href="#activity"><span
                                    class="material-icons">local_activity</span></a></li>
                    </ul>
                    <!-- Tabs -->
                </div>
                <!-- Setting -->
                <div id="settings" class="col s12">
                    <div class="m-t-10 p-10 b-b">
                        <h6 class="font-medium">Layout Settings</h6>
                        <ul class="m-t-15">
                            <li class="m-b-10">
                                <label>
                                    <input type="checkbox" name="theme-view" id="theme-view" />
                                    <span>Dark Theme</span>
                                </label>
                            </li>
                            <li class="m-b-10">
                                <label>
                                    <input type="checkbox" name="sidebar-position" id="sidebar-position" />
                                    <span>Fixed Sidebar</span>
                                </label>
                            </li>
                            <li class="m-b-10">
                                <label>
                                    <input type="checkbox" name="header-position" id="header-position" />
                                    <span>Fixed Header</span>
                                </label>
                            </li>
                            <li class="m-b-10">
                                <label>
                                    <input type="checkbox" name="boxed-layout" id="boxed-layout" />
                                    <span>Boxed Layout</span>
                                </label>
                            </li>
                        </ul>
                    </div>
                    <div class="p-10 b-b">
                        <!-- Logo BG -->
                        <h6 class="font-medium">Logo Backgrounds</h6>
                        <ul class="m-t-15 theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-logobg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-logobg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-logobg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-logobg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-logobg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-logobg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                    <div class="p-10 b-b">
                        <!-- Navbar BG -->
                        <h6 class="font-medium">Navbar Backgrounds</h6>
                        <ul class="m-t-15 theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-navbarbg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-navbarbg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-navbarbg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-navbarbg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-navbarbg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-navbarbg="skin6"></a></li>
                        </ul>
                        <!-- Navbar BG -->
                    </div>
                    <div class="p-10 b-b">
                        <!-- Logo BG -->
                        <h6 class="font-medium">Sidebar Backgrounds</h6>
                        <ul class="m-t-15 theme-color">
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-sidebarbg="skin1"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-sidebarbg="skin2"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-sidebarbg="skin3"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-sidebarbg="skin4"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-sidebarbg="skin5"></a></li>
                            <li class="theme-item"><a href="javascript:void(0)" class="theme-link"
                                    data-sidebarbg="skin6"></a></li>
                        </ul>
                        <!-- Logo BG -->
                    </div>
                </div>
            </div>
        </li>
    </ul>
</aside>
<div class="chat-windows"></div>
@endsection


@section('BeforeCommonJs')

@endsection

@section('AfterCommonJs')<script>
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
    });
</script>
<script src="{{ asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<!--c3 JavaScript -->
<script src="{{ asset('assets/extra-libs/c3/d3.min.js')}}"></script>
<script src="{{ asset('assets/extra-libs/c3/c3.min.js')}}"></script>
<script src="{{ asset('assets/libs/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{ asset('dist/js/pages/dashboards/dashboard1.js')}}"></script>
<script src="{{ asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
@endsection