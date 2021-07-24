@extends('shared.layout')

@section('PageTitle', 'Dashboard')

@section('BeforeCommonCss')
    <link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
@endsection

@section('AfterCommonCss')
    <link href="{{ asset('dist/css/pages/dashboard1.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-wrapper">

        <div class="container-fluid">
            @if (Session::has('AlertType') && Session::has('AlertMsg'))
                <div class="row">
                    <div class="col l12 m12 s12 m-5">
                        <div class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                            {{ Session::get('AlertMsg') }}
                        </div>
                    </div>
                </div>
            @endif
            <div class="row">
                <div class="col l2 m6 s12">
                    <div class="card danger-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ $GroupCount }}</h2>
                                    <h6 class="white-text op-5 light-blue-text">
                                        {{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}
                                    </h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="material-icons">portrait</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('Data.company_nature') == 'S')
                    <div class="col l2 m6 s12">
                        <div class="card info-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h2 class="white-text m-b-5">{{ $SectionCount }}</h2>
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


                <div class="col l2 m6 s12">
                    <div class="card success-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ $MobileDatasCount }}</h2>
                                    <h6 class="white-text op-5 light-blue-text">
                                        {{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}
                                    </h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="material-icons">account_circle</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l2 m6 s12">
                    <div class="card warning-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ Session::get('Data.remaining_of_sms') }}</h2>
                                    <h6 class="white-text op-5">Remaining SMS</h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="material-icons">question_answer</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l2 m6 s12">
                    <div class="card info-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ Session::get('Data.no_of_sms') }}</h2>
                                    <h6 class="white-text op-5">Total SMS</h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="material-icons">question_answer</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l2 m6 s12">
                    <div class="card danger-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h4 class="white-text m-b-5">{{ date_format(new DateTime(Session::get('Data.expiry_date')), 'd/m/Y') }}</h4>
                                    <h6 class="white-text op-5 light-blue-text">Expiry Date</h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="material-icons">data_usage</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <div class="row m-t-25">
                <div class="col l12 m12 s12">
                    <h2>Api Section</h2>
                    <ul class="collapsible popout">
                        <li class="">
                            <div class="collapsible-header"><i class="material-icons">filter_1</i>First</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">filter_2</i>Second</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">filter_3</i>Third</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">filter_4</i>Third</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">filter_5</i>Third</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                        <li>
                            <div class="collapsible-header"><i class="material-icons">filter_6</i>Third</div>
                            <div class="collapsible-body"><span>Lorem ipsum dolor sit amet.</span></div>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
    </div>

@endsection



@section('Js')
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/materialize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
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
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <!--c3 JavaScript -->
    <script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/dashboards/dashboard1.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>
@endsection
