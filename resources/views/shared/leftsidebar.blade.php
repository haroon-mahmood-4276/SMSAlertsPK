<aside class="left-sidebar">
    <ul id="slide-out" class="sidenav ">
        <li>
            <ul class="collapsible m-t-40">
                <li>
                    <a href="{{ route('r.dashboard') }}"
                        class="collapsible-header {{ Request::is(route('r.dashboard')) ? 'active' : null }}"><i
                            class="material-icons">dashboard</i><span class="hide-menu"> Dashboard</span></a>
                </li>
                <li>
                    <a href="{{ route('groups.index') }}"
                        class="collapsible-header {{ Request::is(route('groups.index')) ? 'active' : null }}"><i
                            class="material-icons">school</i><span class="hide-menu">
                            {{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }} Management</span></a>
                </li>
                @if (session('Data.company_nature') != 'B')
                    <li>
                        <a href="{{ route('sections.index') }}"
                            class="collapsible-header {{ Request::is(route('sections.index')) ? 'active' : null }}"><i
                                class="material-icons">device_hub</i>
                            <span class="hide-menu"> Section Management</span></a>
                    </li>
                @endif
                <li>
                    <a href="{{ route('data.index') }}"
                        class="collapsible-header {{ Request::is(route('data.index')) ? 'active' : null }}"><i
                            class="material-icons">person_add</i><span class="hide-menu">
                            {{ session('Data.company_nature') == 'B' ? 'Mambers' : 'Students' }} Management</span></a>
                </li>
                <li>
                    <a href="{{ route('templates.index') }}"
                        class="collapsible-header {{ Request::is(route('data.index')) ? 'active' : null }}"><i
                            class="material-icons">playlist_add</i><span class="hide-menu">
                            Template Management</span></a>
                </li>
                <li>
                    <a href="javascript: void(0);" class="collapsible-header has-arrow"><i
                            class="material-icons">message</i><span class="hide-menu">Messaging</span></a>
                    <div class="collapsible-body">
                        <ul>
                            <ul>
                                <li><a href="{{ route('r.quicksmsshow') }}"><i class="material-icons">message</i><span
                                            class="hide-menu">Quick SMS</span></a></li>
                                <li><a href="{{ route('r.multiplesmsshow') }}"><i
                                            class="material-icons">message</i><span class="hide-menu">Multiple
                                            SMS</span></a></li>
                                <li><a href="{{ route('r.bulksmsshow') }}"><i
                                            class="material-icons">message</i><span class="hide-menu">Bulk
                                            SMS</span></a></li>
                                <li><a href="{{ route('r.smshistory') }}"><i class="material-icons">history</i><span
                                            class="hide-menu">SMS History</span></a></li>
                            </ul>
                        </ul>
                    </div>
                </li>
                 <li>
                    <a href="{{ route('r.imports') }}"
                        class="collapsible-header {{ Request::is(route('r.imports')) ? 'active' : null }}"><i class="material-icons">file_upload</i>
                        <span class="hide-menu"> Imports</span></a>
                </li>
            </ul>
        </li>
    </ul>
</aside>
