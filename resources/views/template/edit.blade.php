@extends('shared.layout')

@section('PageTitle', 'Edit Template')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
@endsection

@section('content')
    <div class="page-wrapper">
            <div class="container-fluid row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title activator">Create Template</h5>
                        <form action="{{ route('templates.update', ['template' => $Template->id]) }}" class="formValidate"
                            id="formValidate" method="POST">
                            @csrf
                            @method('PATCH')
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

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="code" name="code" type="text" class="@error('code') error @enderror"
                                        value="{{ $Template->code }}" maxlength="5">
                                    <label for="code">Code *</label>
                                    @error('code')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="name" name="name" type="text" class="@error('name') error @enderror"
                                        value="{{ $Template->name }}">
                                    <label for="name">Name *</label>
                                    @error('name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col s12 m12 l12">
                                    <p><strong>Tags</strong></p>
                                    <div class="row">
                                        <div class="col s1 m2 l2 m-2">
                                            <a href="javascript:void(0)"
                                                id="{{ session('Data.company_nature') == 'B' ? 'member_full_name' : 'student_full_name' }}"
                                                onmouseup="textbox(this.id)"
                                                class="chip">{{ session('Data.company_nature') == 'B' ? 'Member' : 'Student' }}
                                                Full Name
                                            </a>
                                        </div>
                                        <div class="col s1 m2 l2 m-2">
                                            <a href="javascript:void(0)" id="account_name" onmouseup="textbox(this.id)"
                                                class="chip">Account Name</a>
                                        </div>
                                        @if (session('Data.company_nature') == 'B')
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="brand_name" onmouseup="textbox(this.id)"
                                                    class="chip">Brand Name</a>
                                            </div>
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="brand_phone_1" onmouseup="textbox(this.id)"
                                                    class="chip">Brand Phone No 1</a>
                                            </div>
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="brand_phone_2" onmouseup="textbox(this.id)"
                                                    class="chip">Brand Phone No 2</a>
                                            </div>
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="brand_email" onmouseup="textbox(this.id)"
                                                    class="chip">Brand Email</a>
                                            </div>
                                        @else
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="class_name" onmouseup="textbox(this.id)"
                                                    class="chip">Class Name</a>
                                            </div>
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="section_name" onmouseup="textbox(this.id)"
                                                    class="chip">Section Name</a>
                                            </div>
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="school_name" onmouseup="textbox(this.id)"
                                                    class="chip">School Name</a>
                                            </div>
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="school_phone_1"
                                                    onmouseup="textbox(this.id)" class="chip">School Phone No 1</a>
                                            </div>
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="school_phone_2"
                                                    onmouseup="textbox(this.id)" class="chip">School Phone No 2</a>
                                            </div>
                                            <div class="col s1 m2 l2 m-2">
                                                <a href="javascript:void(0)" id="school_email" onmouseup="textbox(this.id)"
                                                    class="chip">School Email</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>

                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">question_answer</i>
                                    <textarea id="template" name="template"
                                        class="materialize-textarea validate @error('template') error @enderror">{{ $Template->template }}</textarea>
                                    <label for="template">Message *</label>
                                    @error('template')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col s12 m12 l12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Submit
                                    </button>
                                    <a href="{{ route('templates.index') }}"
                                        class="btn waves-effect red waves-light right m-r-10">Back to Template
                                        List</a>
                                </div>
                            </div>
                        </form>
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

    <script type="text/javascript">
        function textbox(Element) {
            var ctl = document.getElementById('template');
            var EndPosition = ctl.selectionEnd;
            ctl.value = [ctl.value.slice(0, EndPosition), "[" + Element + "]", ctl.value.slice(EndPosition, ctl.value
                .length)].join('');
            ctl.focus();
        }
    </script>
@endsection
