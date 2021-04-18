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

<div class="page-wrapper">

    <div class="container-fluid">
        @if (Session::has('AlertType') && Session::has('AlertMsg'))
        <div class="row">
            <div class="col l12 m12 s12 m-5">
                <div class="{{Session::get('AlertType')}}-alert-bar p-15 m-b-20 white-text">
                    {{Session::get('AlertMsg')}}
                </div>
            </div>
        </div>
        @endif
        <div class="row">
            <div class="col l3 m6 s12">
                <div class="card danger-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{$GroupCount}}</h2>
                                <h6 class="white-text op-5 light-blue-text">
                                    {{(session('Data.company_nature') == 'B') ? 'Groups' : 'Classes'}}</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">portrait</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            @if (session('Data.company_nature') != 'B')
            <div class="col l3 m6 s12">
                <div class="card info-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{$SectionCount}}</h2>
                                <h6 class="white-text op-5 text-darken-2">Sections</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">group</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            @endif


            <div class="col l3 m6 s12">
                <div class="card success-gradient card-hover">
                    <div class="card-content">
                        <div class="d-flex no-block align-items-center">
                            <div>
                                <h2 class="white-text m-b-5">{{$MobileDatasCount}}</h2>
                                <h6 class="white-text op-5 light-blue-text">
                                    {{session('Data.company_nature') == 'B' ? 'Members' : 'Students'}}</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">account_circle</i></span>
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
                                <h2 class="white-text m-b-5">{{$RemainingSMS}}</h2>
                                <h6 class="white-text op-5">Remaining SMS</h6>
                            </div>
                            <div class="ml-auto">
                                <span class="white-text display-6"><i class="material-icons">question_answer</i></span>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <!-- ============================================================== -->
        <!-- Sales Summery -->
        <!-- ============================================================== -->
        <div class="row">

            <div class="col s12 m6 l6">
                <div class="card card-hover">
                    <div class="card-content">
                        <div class="d-flex align-items-center">
                            <div class="m-r-20">
                                <h1 class=""><i class="ti-light-bulb"></i></h1>
                            </div>
                            <div>
                                <h3 class="card-title">Sales Analytics</h3>
                                <h6 class="card-subtitle">March 2017</h6>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center">
                            <div class="col s6">
                                <h3 class="font-light m-t-10"><sup><small><i class="ti-arrow-up"></i></small></sup>35487
                                </h3>
                            </div>
                            <div class="col s6 p-t-10 p-b-10 right-align">
                                <div class="p-t-10 p-b-10 m-r-20">
                                    <div class="spark-count" style="height:65px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="col s12 m6 l6">
                <div class="card card-hover">
                    <div class="card-content">
                        <div class="d-flex align-items-center">
                            <div class="m-r-20">
                                <h1 class=""><i class="ti-pie-chart"></i></h1>
                            </div>
                            <div>
                                <h3 class="card-title">Bandwidth usage</h3>
                                <h6 class="card-subtitle">March 2017</h6>
                            </div>
                        </div>
                        <div class="row d-flex align-items-center">
                            <div class="col s6">
                                <h3 class="font-light m-t-10">50 GB</h3>
                            </div>
                            <div class="col s6 p-t-10 p-b-10 right-align">
                                <div class="p-t-10 p-b-10 m-r-20">
                                    <div class="spark-count2" style="height:65px"></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>

@endsection



@section('Js')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{ asset('dist/js/materialize.min.js')}}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{ asset('dist/js/app.js')}}"></script>
{{-- <script src="{{ asset('dist/js/app.init.js')}}"></script> --}}
<script>
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
<script src="{{ asset('dist/js/app-style-switcher.js')}}"></script>
<script src="{{ asset('dist/js/custom.min.js')}}"></script>
<script src="{{ asset('assets/libs/chartist/dist/chartist.min.js')}}"></script>
<script src="{{ asset('assets/libs/chartist-plugin-tooltips/dist/chartist-plugin-tooltip.min.js')}}"></script>
<!--c3 JavaScript -->
<script src="{{ asset('assets/extra-libs/c3/d3.min.js')}}"></script>
<script src="{{ asset('assets/extra-libs/c3/c3.min.js')}}"></script>
<script src="{{ asset('assets/libs/chart.js/dist/Chart.min.js')}}"></script>
<script src="{{ asset('dist/js/pages/dashboards/dashboard1.js')}}"></script>
<script src="{{ asset('assets/extra-libs/sparkline/sparkline.js')}}"></script>
@endsection