<header class="topbar">

    <nav>
        <div class="nav-wrapper">

            <a href="javascript:void(0)" class="brand-logo">
                <span class="icon">
                    <img class="light-logo" src="{{ asset('assets/images/icon-light.png') }}">
                    <img class="dark-logo" src="{{ asset('assets/images/icon-dark.png') }}">
                </span>
                <span class="text">
                    <img class="light-logo" src="{{ asset('assets/images/text-light.png') }}">
                    <img class="dark-logo" src="{{ asset('assets/images/text-dark.png') }}">
                </span>
            </a>
            <!-- ============================================================== -->
            <!-- Logo you can find that scss in header.scss -->
            <!-- ============================================================== -->
            <!-- ============================================================== -->
            <!-- Left topbar icon scss in header.scss -->
            <!-- ============================================================== -->
            <ul class="left">
                <li class="hide-on-med-and-down">
                    <a href="javascript: void(0);" class="nav-toggle">
                        <span class="bars bar1"></span>
                        <span class="bars bar2"></span>
                        <span class="bars bar3"></span>
                    </a>
                </li>
                <li class="hide-on-large-only">
                    <a href="javascript: void(0);" class="sidebar-toggle">
                        <span class="bars bar1"></span>
                        <span class="bars bar2"></span>
                        <span class="bars bar3"></span>
                    </a>
                </li>
                <!-- <li class="search-box">
                    <a href="javascript: void(0);"><i class="material-icons">search</i></a>
                    <form class="app-search">
                        <input type="text" class="form-control" placeholder="Search &amp; enter"> <a class="srh-btn"><i
                                class="ti-close"></i></a>
                    </form>
                </li> -->
            </ul>

            <ul class="right">
                <li><a class="dropdown-trigger" href="javascript: void(0);" data-target="user_dropdown"><img
                            src="{{ asset('assets/images/users/2.jpg') }}" alt="user" class="circle profile-pic"></a>
                    <ul id="user_dropdown" class="mailbox dropdown-content dropdown-user">
                        <li>
                            <div class="dw-user-box">
                                <div class="u-img"><img src="{{ asset('assets/images/users/2.jpg') }}" alt="user">
                                </div>
                                <div class="u-text">
                                    <h4>{{ session('Data.first_name') }} {{ session('Data.last_name') }}
                                    </h4>
                                    <p>{{ session('Data.email') }}</p>
                                    {{-- <a class="waves-effect waves-light btn-small red white-text">View Profile</a> --}}
                                </div>
                            </div>
                        </li>
                        <li role="separator" class="divider"></li>
                        <li><a href="{{ route('r.logout') }}" class="waves-effect waves-light red white-text "><i
                                    class="material-icons">power_settings_new</i> Logout</a></li>
                    </ul>
                </li>
            </ul>

        </div>
    </nav>

</header>
