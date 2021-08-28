<aside class="left-sidebar">
    <ul id="slide-out" class="sidenav ">
        <li>
            <ul class="collapsible m-t-40">
                @if (session('Data.company_nature') == 'B' || session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                    <li>
                        <a href="{{ route('r.dashboard') }}"
                            class="collapsible-header {{ Request::is(route('r.dashboard')) ? 'active' : null }}"><i
                                class="material-icons">dashboard</i><span class="hide-menu"> Dashboard</span></a>
                    </li>
                    <li>
                        <a href="{{ session('Data.company_nature') == 'B' ? route('groups.index') : route('classes.index') }}"
                            class="collapsible-header {{ Request::is(route(session('Data.company_nature') == 'B' ? 'groups.index' : 'classes.index')) ? 'active' : null }}"><i
                                class="material-icons">school</i><span class="hide-menu">
                                {{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}
                                Management</span></a>
                    </li>
                    @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                        <li>
                            <a href="{{ route('sections.index') }}"
                                class="collapsible-header {{ Request::is(route('sections.index')) ? 'active' : null }}"><i
                                    class="material-icons">device_hub</i>
                                <span class="hide-menu"> Sections Management</span></a>
                        </li>
                    @endif
                    @if (session('Data.company_nature') == 'HE')
                        <li>
                            <a href="{{ route('subjects.index') }}"
                                class="collapsible-header {{ Request::is(route('subjects.index')) ? 'active' : null }}"><i
                                    class="material-icons">subject</i>
                                <span class="hide-menu"> Subjects Management</span></a>
                        </li>
                        <li>
                            <a href="{{ route('teachers.index') }}"
                                class="collapsible-header {{ Request::is(route('teachers.index')) ? 'active' : null }}"><i
                                    class="material-icons">school</i>
                                <span class="hide-menu"> Teachers Management</span></a>
                        </li>
                    @endif
                    <li>
                        <a href="{{ route('data.index') }}"
                            class="collapsible-header {{ Request::is(route('data.index')) ? 'active' : null }}"><i
                                class="material-icons">person_add</i><span class="hide-menu">
                                {{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}
                                Management</span></a>
                    </li>
                    <li>
                        <a href="{{ route('templates.index') }}"
                            class="collapsible-header {{ Request::is(route('templates.index')) ? 'active' : null }}"><i
                                class="material-icons">playlist_add</i><span class="hide-menu">
                                Template</span></a>
                    </li>
                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">message</i><span class="hide-menu">Messaging</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <ul>

                                    <li>
                                        <a href="{{ route('r.bulk-sms-view') }}">
                                            <i class="material-icons">message</i>
                                            <span class="hide-menu">Bulk SMS</span>
                                        </a>
                                    </li>
                                    @if (session('Data.company_nature') == 'S')
                                        <li>
                                            <a href="{{ route('r.dues-sms-view') }}">
                                                <i class="material-icons">message</i>
                                                <span class="hide-menu">Dues SMS</span>
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a href="{{ route('r.multiple-sms-view') }}">
                                            <i class="material-icons">message</i>
                                            <span class="hide-menu">Multiple SMS</span>
                                        </a>
                                    </li>
                                    <li>
                                        <a href="{{ route('r.quick-sms-view') }}">
                                            <i class="material-icons">message</i>
                                            <span class="hide-menu">Quick SMS</span>
                                        </a>
                                    </li>

                                </ul>
                            </ul>
                        </div>
                    </li>
                    @if (session('Data.company_nature') == 'S')
                        @if (session('UserSettings.attendance_enabled') == 'Y')
                            <li>
                                <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                        class="material-icons">assignment_turned_in</i><span
                                        class="hide-menu">Attendance
                                        System</span></a>
                                <div class="collapsible-body">
                                    <ul>
                                        <ul>
                                            <li
                                                class="{{ Request::is(route('r.manual-attendance-view')) ? 'active' : null }}">
                                                <a href="{{ route('r.manual-attendance-view') }}"
                                                    class="{{ Request::is(route('r.manual-attendance-view')) ? 'active' : null }}">
                                                    <i class="material-icons">assignment_turned_in</i>
                                                    <span class="hide-menu">Manual Attendance</span>
                                                </a>
                                            </li>
                                            @if (session('UserSettings.attendance_database_path_enabled') == 'Y')
                                                <li
                                                    class="{{ Request::is(route('r.device-attendance-view')) ? 'active' : null }}">
                                                    <a href="{{ route('r.device-attendance-view') }}"
                                                        class="{{ Request::is(route('r.device-attendance-view')) ? 'active' : null }}">
                                                        <i class="material-icons">assignment_turned_in</i>
                                                        <span class="hide-menu">Device Attendance</span>
                                                    </a>
                                                </li>
                                            @endif
                                        </ul>
                                    </ul>
                                </div>
                            </li>
                        @endif
                    @endif
                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">receipt</i><span class="hide-menu">Reports</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <li>
                                    <a href="{{ route('r.todaysummery') }}" target="_blank">
                                        <i class="material-icons">receipt</i>
                                        <span class="hide-menu">Today's Summery</span>
                                    </a>
                                </li>
                                <li>
                                    <a href="{{ route('r.personalizedreport') }}">
                                        <i class="material-icons">receipt</i>
                                        <span class="hide-menu">Personalized Reports</span>
                                    </a>
                                </li>
                            </ul>
                        </div>
                    </li>
                    <li>
                        <a href="{{ route('r.imports') }}"
                            class="collapsible-header {{ Request::is(route('r.imports')) ? 'active' : null }}"><i
                                class="material-icons">file_upload</i>
                            <span class="hide-menu"> Imports</span></a>
                    </li>
                    @if (session('Data.company_nature') == 'S')
                        <li>
                            <a href="{{ route('r.settings') }}"
                                class="collapsible-header {{ Request::is(route('r.settings')) ? 'active' : null }}"><i
                                    class="material-icons">settings</i>
                                <span class="hide-menu"> Settings</span></a>
                        </li>
                    @endif
                    <li>
                        <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                                class="material-icons">developer_mode</i><span class="hide-menu">API
                                Documentation</span></a>
                        <div class="collapsible-body">
                            <ul>
                                <ul>

                                    <li>
                                        <a
                                            href="{{ Session::get('Data.company_nature') == 'B' ? route('r.apigroup') : route('r.apiclass') }}">
                                            <i class="material-icons">developer_mode</i>
                                            <span
                                                class="hide-menu">{{ Session::get('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}
                                                API</span>
                                        </a>
                                    </li>
                                    @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                        <li>
                                            <a href="{{ route('r.apisection') }}">
                                                <i class="material-icons">developer_mode</i>
                                                <span class="hide-menu">Section API</span>
                                            </a>
                                        </li>
                                    @endif
                                    <li>
                                        <a
                                            href="{{ Session::get('Data.company_nature') == 'B' ? route('r.apimember') : route('r.apistudent') }}">
                                            <i class="material-icons">developer_mode</i>
                                            <span
                                                class="hide-menu">{{ Session::get('Data.company_nature') == 'B' ? 'Members' : 'Students' }}
                                                API</span>
                                        </a>
                                    </li>
                                </ul>
                            </ul>
                        </div>
                    </li>
                @elseif (session('Data.company_nature') == 'T')
                    <li>
                        <a href="{{ route('r.teacher-attendance') }}"
                            class="collapsible-header {{ Request::is(route('r.teacher-attendance')) ? 'active' : null }}"><i
                                class="material-icons">group</i>
                            <span class="hide-menu"> Attendance</span></a>
                    </li>
                @else
                    <li>
                        <a href="{{ route('users.index') }}"
                            class="collapsible-header {{ Request::is(route('users.index')) ? 'active' : null }}"><i
                                class="material-icons">group</i>
                            <span class="hide-menu"> User Management</span></a>
                    </li>
                @endif
            </ul>
        </li>
    </ul>
</aside>
