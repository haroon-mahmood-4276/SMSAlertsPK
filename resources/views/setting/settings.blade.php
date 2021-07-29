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
                {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">Settings</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col l12 m12 s12">
                    <div class="card">
                        <div class="card-content">
                            <h5 class="card-title">Birthday Template</h5>

                            <form action="{{ route('templates.store') }}" class="formValidate" id="formValidate"
                                method="POST">
                                @csrf
                                @if (Session::get('AlertType') && Session::get('AlertMsg'))
                                    <div class="row">
                                        <div class="col l12 m12 s12 m-5">
                                            <div class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                                                {{ Session::get('AlertMsg') }}
                                            </div>
                                        </div>
                                    </div>
                                @endif
                                <div class="row">
                                    <div class="col s2">
                                        <p>
                                            <label>
                                                <input type="checkbox" />
                                                <span>Enabled</span>
                                            </label>
                                        </p>
                                        <br>
                                        <div class="input-field">
                                            <input id="a6" type="time">
                                            <label for="a6">Numbers</label>
                                        </div>
                                    </div>
                                    <div class="col s12 m12 l12">
                                        <p><strong>Tags</strong></p>
                                        <div class="row">
                                            <div class="col s1 m2 l2">
                                                <a href="javascript:void(0)"
                                                    id="{{ session('Data.company_nature') == 'B' ? 'member_full_name' : 'student_full_name' }}"
                                                    onmouseup="textbox(this.id)"
                                                    class="chip">{{ session('Data.company_nature') == 'B' ? 'Member' : 'Student' }}
                                                    Full Name
                                                </a>
                                            </div>
                                            <div class="col s1 m2 l2">
                                                <a href="javascript:void(0)" id="account_name" onmouseup="textbox(this.id)"
                                                    class="chip">Account Name</a>
                                            </div>
                                            @if (session('Data.company_nature') == 'B')
                                                <div class="col s1 m2 l2">
                                                    <a href="javascript:void(0)" id="brand_name"
                                                        onmouseup="textbox(this.id)" class="chip">Brand Name</a>
                                                </div>
                                                <div class="col s1 m2 l2">
                                                    <a href="javascript:void(0)" id="brand_mask"
                                                        onmouseup="textbox(this.id)" class="chip">Brand Mask</a>
                                                </div>
                                                <div class="col s1 m2 l2">
                                                    <a href="javascript:void(0)" id="brand_email"
                                                        onmouseup="textbox(this.id)" class="chip">Brand Email</a>
                                                </div>
                                            @else
                                                <div class="col s1 m2 l2">
                                                    <a href="javascript:void(0)" id="class_name"
                                                        onmouseup="textbox(this.id)" class="chip">Class Name</a>
                                                </div>
                                                <div class="col s1 m2 l2">
                                                    <a href="javascript:void(0)" id="section_name"
                                                        onmouseup="textbox(this.id)" class="chip">Section Name</a>
                                                </div>
                                                <div class="col s1 m2 l2">
                                                    <a href="javascript:void(0)" id="school_name"
                                                        onmouseup="textbox(this.id)" class="chip">School Name</a>
                                                </div>
                                                <div class="col s1 m2 l2">
                                                    <a href="javascript:void(0)" id="school_mask"
                                                        onmouseup="textbox(this.id)" class="chip">School Mask</a>
                                                </div>
                                                <div class="col s1 m2 l2">
                                                    <a href="javascript:void(0)" id="school_email"
                                                        onmouseup="textbox(this.id)" class="chip">School Email</a>
                                                </div>
                                            @endif
                                        </div>
                                    </div>

                                    <div class="input-field col s12 m12 l12">
                                        <i class="material-icons prefix">question_answer</i>
                                        <label for="message">Message *</label>
                                        <textarea id="message" name="message"
                                            class="materialize-textarea count-message-character @error('message') error @enderror"
                                            value="{{ old('message') }}"></textarea>
                                        <span class="character-counter" id="message-character-counter"
                                            style="float: right; font-size: 12px;"> &nbsp;</span>
                                        @error('message')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="col s12 m12 l12">
                                        <button class="btn waves-effect waves-light right submit" type="submit"
                                            name="action">Save
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
            var ctl = document.getElementById('message');
            var EndPosition = ctl.selectionEnd;
            ctl.value = [ctl.value.slice(0, EndPosition), "[" + Element + "]", ctl.value.slice(EndPosition, ctl.value
                .length)].join('');

            ctl.focus();
        }
    </script>
@endsection
