@extends('shared.layout')

@section('PageTitle', 'Settings')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
    <link href="{{ asset('assets/libs/footable/css/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-titles">
            <div class="d-flex align-items-center">
                <h3 class="font-medium m-b-0">Settings</h3>
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">Settings</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                @if (Session::get('AlertType') && Session::get('AlertMsg'))
                    <div class="col l12 m12 s12">
                        <div class="{{ Session::get('AlertType') }}-alert-bar m-b-15 p-15 white-text">
                            {{ Session::get('AlertMsg') }}
                        </div>
                    </div>
                @endif
                <div class="col l12 m12 s12">
                    <div class="card">
                        <div class="card-content">
                            <h3 class="card-title">Birthday Template</h3>
                            <form action="{{ route('r.settings-birthday') }}" class="formValidate"
                                id="birthday_settings_form" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6 l3">
                                        <p>
                                            <label>
                                                <input type="checkbox" id="is_enabled" class="filled-in"
                                                    name="is_enabled"
                                                    {{ $Setting->birthday_enabled == 'Y' ? 'checked' : '' }} />
                                                <span>Enabled</span>
                                            </label>
                                        </p>
                                    </div>

                                    <div class="input-field col s12 m12 l12">
                                        <i class="material-icons prefix">question_answer</i>
                                        <label for="message">Message *</label>
                                        <textarea id="message" name="message"
                                            {{ $Setting->birthday_enabled == 'Y' ? '' : 'disabled' }}
                                            class="materialize-textarea count-message-character @error('message') error @enderror">{{ $Setting->birthday_message }}</textarea>
                                        <span class="character-counter" id="message-character-counter"
                                            style="float: right; font-size: 12px;"> &nbsp;</span>
                                        @error('message')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col s12 m12 l12 m-b-20">
                                        <p><strong>Tags</strong></p>
                                        <div class="row">
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="student_full_name"
                                                    onmouseup="textbox(this.id)" class="chip">Student Full Name
                                                </a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="class_name" onmouseup="textbox(this.id)"
                                                    class="chip">Class Name</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="section_name" onmouseup="textbox(this.id)"
                                                    class="chip">Section Name</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_name" onmouseup="textbox(this.id)"
                                                    class="chip">School Name</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_phone_1"
                                                    onmouseup="textbox(this.id)" class="chip">School Phone No
                                                    1</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_phone_2"
                                                    onmouseup="textbox(this.id)" class="chip">School Phone No
                                                    2</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_email" onmouseup="textbox(this.id)"
                                                    class="chip">School Email</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col s12 m-t-25">
                                        <h6><strong>SMS To</strong></h6>
                                        <div class="row">
                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="parent_primary_number"
                                                            class="filled-in" name="parent_primary_number"
                                                            {{ $Setting->parent_primary_number == 'Y' ? 'checked' : '' }}
                                                            {{ $Setting->birthday_enabled == 'N' ? 'disabled' : '' }} />
                                                        <span>Parent Primary Number</span>
                                                    </label>
                                                </p>
                                            </div>

                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="parent_secondary_number"
                                                            class="filled-in" name="parent_secondary_number"
                                                            {{ $Setting->parent_secondary_number == 'Y' ? 'checked' : '' }}
                                                            {{ $Setting->birthday_enabled == 'N' ? 'disabled' : '' }} />
                                                        <span>Parent Secondary Number</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="student_primary_number"
                                                            class="filled-in" name="student_primary_number"
                                                            {{ $Setting->student_primary_number == 'Y' ? 'checked' : '' }}
                                                            {{ $Setting->birthday_enabled == 'N' ? 'disabled' : '' }} />
                                                        <span>Student Primary Number</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="student_secondary_number"
                                                            class="filled-in" name="student_secondary_number"
                                                            {{ $Setting->student_secondary_number == 'Y' ? 'checked' : '' }}
                                                            {{ $Setting->birthday_enabled == 'N' ? 'disabled' : '' }} />
                                                        <span>Student Secondary Number</span>
                                                    </label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col s12 m12 l12">
                                        <button class="btn waves-effect waves-light right submit" type="submit"
                                            name="birthday_settings_button" id="birthday_settings_button">Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    <div class="card">
                        <div class="card-content">
                            <h3 class="card-title">Attendance Template</h3>
                            <form action="{{ route('r.settings-attendance') }}" class="formValidate"
                                id="attendance_settings_form" enctype="multipart/form-data" method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6 l3">
                                        <p>
                                            <label>
                                                <input type="checkbox" id="attendance_enabled" class="filled-in"
                                                    name="attendance_enabled"
                                                    {{ $Setting->attendance_enabled == 'Y' ? 'checked' : '' }} />
                                                <span>Enabled</span>
                                            </label>
                                        </p>
                                    </div>

                                    <div class="input-field col s12 m12 l12">
                                        <i class="material-icons prefix">question_answer</i>
                                        <label for="attendance_message">Message *</label>
                                        <textarea id="attendance_message" name="attendance_message"
                                            {{ $Setting->attendance_enabled == 'Y' ? '' : 'disabled' }}
                                            class="materialize-textarea count-message-character @error('attendance_message') error @enderror">{{ $Setting->attendance_message }}</textarea>
                                        <span class="character-counter" id="message-character-counter"
                                            style="float: right; font-size: 12px;"> &nbsp;</span>
                                        @error('attendance_message')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col s12 m12 l12 m-b-20">
                                        <p><strong>Tags</strong></p>
                                        <div class="row">
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="student_full_name"
                                                    onmouseup="AttendanceTags(this.id)" class="chip">Student Full
                                                    Name
                                                </a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="class_name"
                                                    onmouseup="AttendanceTags(this.id)" class="chip">Class
                                                    Name</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="section_name"
                                                    onmouseup="AttendanceTags(this.id)" class="chip">Section
                                                    Name</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="father_full_name"
                                                    onmouseup="AttendanceTags(this.id)" class="chip">Father Full
                                                    Name</a>
                                            </div>
                                            @if (session('Data.company_nature') == 'HE')
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="subject_name"
                                                        onmouseup="AttendanceTags(this.id)" class="chip">Subject
                                                        Name</a>
                                                </div>
                                            @endif
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_name"
                                                    onmouseup="AttendanceTags(this.id)" class="chip">School
                                                    Name</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_phone_1"
                                                    onmouseup="AttendanceTags(this.id)" class="chip">School Phone
                                                    No 1</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_phone_2"
                                                    onmouseup="AttendanceTags(this.id)" class="chip">School Phone
                                                    No 2</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_email"
                                                    onmouseup="AttendanceTags(this.id)" class="chip">School
                                                    Email</a>
                                            </div>
                                        </div>
                                    </div>

                                    <div class="col s12 m-t-25">
                                        <h6><strong>SMS To</strong></h6>
                                        <div class="row">
                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="attendance_parent_primary_number"
                                                            class="filled-in" name="attendance_parent_primary_number"
                                                            {{ $Setting->attendance_parent_primary_number == 'Y' ? 'checked' : '' }}
                                                            {{ $Setting->attendance_enabled == 'N' ? 'disabled' : '' }} />
                                                        <span>Parent Primary Number</span>
                                                    </label>
                                                </p>
                                            </div>

                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="attendance_parent_secondary_number"
                                                            class="filled-in" name="attendance_parent_secondary_number"
                                                            {{ $Setting->attendance_parent_secondary_number == 'Y' ? 'checked' : '' }}
                                                            {{ $Setting->attendance_enabled == 'N' ? 'disabled' : '' }} />
                                                        <span>Parent Secondary Number</span>
                                                    </label>
                                                </p>
                                            </div>
                                        </div>
                                    </div>

                                    @if (session('Data.company_nature') == 'S')
                                        <div class="col s12 m12 l12 m-t-40">
                                            <h6><strong>In case you have ZKTeco Device, enter the path of MS Access
                                                    database(.mdb, .accdb)</strong></h6>
                                            <p>
                                                <label>
                                                    <input type="checkbox" id="attendance_database_path_enabled"
                                                        class="filled-in" name="attendance_database_path_enabled"
                                                        {{ $Setting->attendance_enabled == 'N' ? 'disabled' : '' }}
                                                        {{ $Setting->attendance_database_path_enabled == 'Y' ? 'checked' : '' }} />
                                                    <span>Enable</span>
                                                </label>
                                            </p>
                                        </div>

                                        <div class="input-field col s12 m12 l12">
                                            <i class="material-icons prefix">text_format</i>
                                            <input id="attendance_database_path" name="attendance_database_path" type="text"
                                                class="@error('attendance_database_path') error @enderror"
                                                value="{{ $Setting->attendance_database_path }}"
                                                placeholder="\path\to\file.mdb or \path\to\file.accdb"
                                                {{ $Setting->attendance_enabled == 'N' ? 'disabled' : '' }}
                                                {{ $Setting->attendance_database_path_enabled == 'Y' ? '' : 'disabled' }}
                                                required>
                                            <label for="attendance_database_path">Access Database Path</label>
                                            @error('attendance_database_path')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror

                                            {{-- <div class="row">
                                            <div class="col s12">
                                                <div class="file-field input-field col s12 m12 l12 ">
                                                    <div class="btn">
                                                        <span>File</span>
                                                        <input type="file" name="attendance_database_path">
                                                    </div>
                                                    <div class="file-path-wrapper">
                                                        <input class="file-path validate" type="text"
                                                            placeholder="Please upload only .mdb or .accdb">
                                                    </div>
                                                </div>
                                                <div class="progress" style="display: none;">
                                                    <div class="determinate" style="width: 0%;"></div>
                                                </div>
                                            </div>
                                        </div> --}}
                                        </div>
                                    @endif
                                    <div class="col s12 m12 l12">
                                        <button class="btn waves-effect waves-light right submit" type="submit"
                                            name="attendance_settings_button" id="attendance_settings_button">Save
                                        </button>
                                    </div>
                                </div>
                            </form>
                        </div>
                    </div>

                    @if (session('Data.company_nature') == 'HE')
                        <div class="card">
                            <div class="card-content">
                                <h3 class="card-title">Premises Geo Location</h3>
                                <div class="row">
                                    <div class="col s12 m6 l6">
                                        <div id="map"
                                            style="width:100%; height:500px; border: 2px solid #6b00b5; border-radius: 10px;">
                                        </div>
                                    </div>
                                    <div class="col s12 m6 l6 m-t-30">
                                        <div class="row">
                                            <div class="col s12 m12 l12">
                                                <form action="{{ route('r.settings-geo-location') }}"
                                                    class="formValidate" id="geo_settings_form" method="POST">
                                                    @csrf
                                                    <div class="row">
                                                        <div class="col s12 m12 l12">
                                                            <div class="row">
                                                                <div class="col s12 m6 l6">
                                                                    <p>
                                                                        <label>
                                                                            <input type="checkbox" id="geo_location_enabled"
                                                                                class="filled-in"
                                                                                name="geo_location_enabled"
                                                                                {{ $Setting->geo_location_enabled == 'Y' ? 'checked' : '' }} />
                                                                            <span>Enabled</span>
                                                                        </label>
                                                                    </p>
                                                                </div>
                                                                <div class="col s12 m6 l6"><button
                                                                        class=" btn-floating waves-effect waves-light right"
                                                                        type="button" name="location"
                                                                        {{ $Setting->geo_location_enabled == 'Y' ? '' : 'disabled' }}
                                                                        onclick="getLocation()" id="location"><i
                                                                            class="material-icons">my_location</i>
                                                                    </button>
                                                                    <p id="demo" style="color: red !important;">&nbsp;</p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                        <div class="input-field col s12 m12 l6">
                                                            <i class="material-icons prefix">text_format</i>
                                                            <input id="latitude" onchange="updateMap()" name="latitude" type="text"
                                                                {{ $Setting->geo_location_enabled == 'Y' ? '' : 'disabled' }}
                                                                class="" value="{{ $Setting->latitude }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                                                >
                                                            <label for="latitude">Latitude</label>
                                                        </div>
                                                        <div class="input-field col s12 m12 l6">
                                                            <i class="material-icons prefix">text_format</i>
                                                            <input id="longitude" onchange="updateMap()" name="longitude" type="text"
                                                                {{ $Setting->geo_location_enabled == 'Y' ? '' : 'disabled' }}
                                                                class="" value="{{ $Setting->longitude }}" oninput="this.value = this.value.replace(/[^0-9.]/g, '');"
                                                                >
                                                            <label for="longitude">Longitude</label>
                                                        </div>
                                                        <div class="input-field col s12 m12 l6">
                                                            <i class="material-icons prefix">text_format</i>
                                                            <input id="radius" onchange="updateMap()" name="radius" type="text"
                                                                {{ $Setting->geo_location_enabled == 'Y' ? '' : 'disabled' }}
                                                                class="" value="{{ $Setting->radius }}" oninput="this.value = this.value.replace(/[^0-9]/g, '');">
                                                            <label for="radius">Radius(m)</label>
                                                        </div>
                                                        <div class="col s12 m12 l12">
                                                            <button class="btn waves-effect waves-light right submit"
                                                                type="submit" name="geo_settings_button"
                                                                id="geo_settings_button">Save
                                                            </button>
                                                        </div>
                                                    </div>
                                                </form>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endif
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
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.form/4.3.0/jquery.form.min.js"></script>


    <script
        src="https://maps.googleapis.com/maps/api/js?key=AIzaSyAU7HZDktEys9hGGuIeW46Rn-VyCBa_exE&callback=initMap&libraries=&v=weekly"
        async>
    </script>
    <script>
        var Coordinates;
        var map;
        var marker;
        var cityCircle;

        function initMap() {
            Coordinates = {
                lat: parseFloat(document.getElementById("latitude").value),
                lng: parseFloat(document.getElementById("longitude").value)
            };

            map = new google.maps.Map(document.getElementById("map"), {
                zoom: 17,
                center: Coordinates,
                scaleControl: true,
                scrollwheel: true,
                panControl: true,
                zoomControl: true,
                mapTypeControl: true,
                streetViewControl: true,
                overviewMapControl: true,
            });

            marker = new google.maps.Marker({
                position: Coordinates,
                map,
                animation: google.maps.Animation.DROP,
                draggable: true
            });

            cityCircle = new google.maps.Circle({
                strokeColor: '#6b00b5',
                strokeOpacity: 1,
                strokeWeight: 1,
                fillColor: '#6b00b5',
                fillOpacity: 0.25,
                map: map,
                center: Coordinates,
                radius: parseFloat(document.getElementById("radius").value),
                draggable: false
            });

            google.maps.event.addListener(marker, "drag", (event) => {
                document.getElementById("latitude").value = parseFloat(event.latLng.lat().toFixed(7));
                document.getElementById("longitude").value = parseFloat(event.latLng.lng().toFixed(7));
                cityCircle.setCenter(event.latLng);
            });

            google.maps.event.addListener(map, 'click', function(event) {
                marker.setPosition(event.latLng);
                document.getElementById("latitude").value = parseFloat(event.latLng.lat().toFixed(7));
                document.getElementById("longitude").value = parseFloat(event.latLng.lng().toFixed(7));
                cityCircle.setCenter(event.latLng);
            });
        }

        var x = document.getElementById("demo");

        function getLocation() {
            if (navigator.geolocation) {
                navigator.geolocation.getCurrentPosition(showPosition, showError);
            } else {
                x.innerHTML = "Geolocation is not supported by this browser.";
            }
        }

        function updateMap() {
            marker.setPosition(new google.maps.LatLng(parseFloat($('#latitude').val()), parseFloat($('#longitude').val())));
            cityCircle.setRadius(parseInt($('#radius').val()));
        }

        function showPosition(position) {
            x.innerHTML = "";
            document.getElementById("latitude").value = parseFloat(position.coords.latitude);
            document.getElementById("longitude").value = parseFloat(position.coords.longitude);
            document.getElementById("radius").value = parseFloat(0);

            initMap();
        }

        function showError(error) {
            switch (error.code) {
                case error.PERMISSION_DENIED:
                    x.innerHTML = "User denied the request for Geolocation.";
                    break;
                case error.POSITION_UNAVAILABLE:
                    x.innerHTML = "Location information is unavailable."
                    break;
                case error.TIMEOUT:
                    x.innerHTML = "The request to get user location timed out."
                    break;
                case error.UNKNOWN_ERROR:
                    x.innerHTML = "An unknown error occurred."
                    break;
            }
            document.getElementById("latitude").value = parseFloat(0);
            document.getElementById("longitude").value = parseFloat(0);
            document.getElementById("radius").value = parseFloat(0);
            // initMap();
        }

        function textbox(Element) {
            if (document.getElementById('is_enabled').checked) {
                var ctl = document.getElementById('message');
                var EndPosition = ctl.selectionEnd;
                ctl.value = [ctl.value.slice(0, EndPosition), "[" + Element + "]", ctl.value.slice(EndPosition, ctl.value
                    .length)].join('');

                ctl.focus();
            }
        }

        $("#is_enabled").on('click', function() {
            // $('#action').prop("disabled", !this.checked);
            $('#message').prop("disabled", !this.checked);
            $('#parent_primary_number').prop("disabled", !this.checked).prop("checked", true);
            $('#parent_secondary_number').prop("disabled", !this.checked).prop("checked", false);
            $('#student_primary_number').prop("disabled", !this.checked).prop("checked", false);
            $('#student_secondary_number').prop("disabled", !this.checked).prop("checked", false);

            if ($('#is_enabled').prop("checked") == false) {
                $('#message').val('');
            }
        });

        $("#attendance_enabled").on('click', function() {

            $('#attendance_message').prop("disabled", !this.checked);
            $('#attendance_parent_primary_number').prop("disabled", !this.checked).prop("checked", true);
            $('#attendance_parent_secondary_number').prop("disabled", !this.checked).prop("checked", false);
            $('#attendance_database_path_enabled').prop("disabled", !this.checked).prop("checked", false);
            if (this.checked == false) {
                $('#attendance_database_path').prop("disabled", true);
            }

            if ($('#attendance_enabled').prop("checked") == false) {
                $('#attendance_message').val('');
                $('#attendance_database_path').val('');
            }
        });

        $("#attendance_database_path_enabled").on('click', function() {
            $('#attendance_database_path').prop("disabled", !this.checked).prop("checked", false);

            if ($('#attendance_database_path_enabled').prop("checked") == false) {
                $('#attendance_database_path').val('');
            }
        });

        function AttendanceTags(Element) {
            if (document.getElementById('attendance_enabled').checked) {
                var ctl = document.getElementById('attendance_message');
                var EndPosition = ctl.selectionEnd;
                ctl.value = [ctl.value.slice(0, EndPosition), "[" + Element + "]", ctl.value.slice(EndPosition, ctl.value
                    .length)].join('');

                ctl.focus();
            }
        }

        $("#geo_location_enabled").on('click', function() {
            $('#demo').text('');
            $('#location').prop("disabled", !this.checked);
            $('#latitude').prop("disabled", !this.checked);
            $('#longitude').prop("disabled", !this.checked);
            $('#radius').prop("disabled", !this.checked);

            if ($('#geo_location_enabled').prop("checked") === false) {
                $('#latitude').val('0');
                $('#longitude').val('0');
                $('#radius').val('0');
            }
        });

        $('#geo_settings_form').on('keyup keypress', function(e) {
            var keyCode = e.keyCode || e.which;
            if (keyCode === 13) {
                e.preventDefault();
                return false;
            }
        });
    </script>
@endsection
