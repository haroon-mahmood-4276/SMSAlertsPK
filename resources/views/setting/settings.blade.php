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
                            <form action="{{ route('r.birthdaysettings') }}" class="formValidate" id="formValidate"
                                method="POST">
                                @csrf
                                <div class="row">
                                    <div class="col s12 m6 l3">
                                        <p>
                                            <label>
                                                <input type="checkbox" id="is_enabled" class="filled-in" name="is_enabled"
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
                                                <a href="javascript:void(0)"
                                                    id="{{ session('Data.company_nature') == 'B' ? 'member_full_name' : 'student_full_name' }}"
                                                    onmouseup="textbox(this.id)"
                                                    class="chip">{{ session('Data.company_nature') == 'B' ? 'Member' : 'Student' }}
                                                    Full Name
                                                </a>
                                            </div>
                                            @if (session('Data.company_nature') == 'B')
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="brand_name"
                                                        onmouseup="textbox(this.id)" class="chip">Brand Name</a>
                                                </div>
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="brand_phone_1"
                                                        onmouseup="textbox(this.id)" class="chip">Brand Phone No 1</a>
                                                </div>
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="brand_phone_2"
                                                        onmouseup="textbox(this.id)" class="chip">Brand Phone No 2</a>
                                                </div>
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="brand_email"
                                                        onmouseup="textbox(this.id)" class="chip">Brand Email</a>
                                                </div>
                                            @else
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="class_name"
                                                        onmouseup="textbox(this.id)" class="chip">Class Name</a>
                                                </div>
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="section_name"
                                                        onmouseup="textbox(this.id)" class="chip">Section Name</a>
                                                </div>
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="school_name"
                                                        onmouseup="textbox(this.id)" class="chip">School Name</a>
                                                </div>
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="school_phone_1"
                                                        onmouseup="textbox(this.id)" class="chip">School Phone No 1</a>
                                                </div>
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="school_phone_2"
                                                        onmouseup="textbox(this.id)" class="chip">School Phone No 2</a>
                                                </div>
                                                <div class="col s6 m3 l2 m-2">
                                                    <a href="javascript:void(0)" id="school_email"
                                                        onmouseup="textbox(this.id)" class="chip">School Email</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col s12 m-t-25">
                                        <h6><strong>SMS To</strong></h6>
                                        <div class="row">
                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="parent_primary_number" class="filled-in"
                                                            name="parent_primary_number"
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
                                            @if (session('Data.company_nature') == 'S')
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
                                            @endif
                                        </div>
                                    </div>

                                    <div class="col s12 m12 l12">
                                        <button class="btn waves-effect waves-light right submit" type="submit"
                                            name="action" id="action">Save
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
@endsection

@section('Js')
    <script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/materialize.min.js') }}"></script>
    <script src="{{ asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
    <script src="{{ asset('dist/js/app.js') }}"></script>
    <script src="{{ asset('dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>

    <script>
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
    </script>
@endsection
