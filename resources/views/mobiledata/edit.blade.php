@extends('shared.layout')

@section('PageTitle', 'Edit ' . @(session('Data.company_nature') == 'B') ? 'Member' : 'Student')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endsection

@section('content')
    <div class="page-wrapper">
            <div class="container-fluid row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Edit
                            {{ session('Data.company_nature') == 'B' ? 'Member' : 'Student' }}
                        </h5>
                        <form action="{{ route('data.update', ['data' => $MobileData->id]) }}" method="POST">
                            @csrf
                            @method('PUT')
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
                                    <select class="form-select" name="group" id="group">
                                        <option value="">Select</option>
                                        @foreach ($Groups as $Group)
                                            <option value="{{ $Group->id }}"
                                                {{ $Group->id == $MobileData->group_id ? 'selected' : '' }}>{{ $Group->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="group" class="form-label">{{session('Data.company_nature') == 'B' ? 'Groups' : 'Classes'}}</label>
                                    @error('group')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if (session('Data.company_nature') == 'S')
                                    <div class="input-field col s6">
                                        <select class="form-select" name="section" id="section">
                                            @foreach ($Sections as $Section)
                                                <option value="{{ $Section->id }}"
                                                    {{ $Section->id == $MobileData->section_id ? 'selected' : '' }}>{{ $Section->name }}
                                                </option>
                                            @endforeach
                                        </select>
                                        <label for="section" class="form-label">Section</label>
                                        @error('section')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="input-field col {{ session('Data.company_nature') == 'B' ? 's6' : 's12' }}">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="code" name="code" type="text" class="@error('code') error @enderror"
                                        value="{{ $MobileData->code }}" disabled>
                                    <label for="code">Code *</label>
                                    @error('code')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="student_first_name" name="student_first_name" type="text"
                                        class="@error('student_first_name') error @enderror"
                                        value="{{ $MobileData->student_first_name }}">
                                    <label for="student_first_name">First Name *</label>
                                    @error('student_first_name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="student_last_name" name="student_last_name" type="text"
                                        class="@error('student_last_name') error @enderror"
                                        value="{{ $MobileData->student_last_name }}">
                                    <label for="student_last_name">Last Name *</label>
                                    @error('student_last_name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="student_mobile_1" name="student_mobile_1" type="text"
                                        class="@error('student_mobile_1') error @enderror"
                                        value="{{ session('Data.company_nature') == 'B' ? $MobileData->parent_mobile_1 : $MobileData->student_mobile_1 }}"
                                        placeholder="923001234567">
                                    <label for="student_mobile_1">Primary Mobile Number *</label>
                                    @error('student_mobile_1')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="student_mobile_2" name="student_mobile_2" type="text"
                                        class="@error('student_mobile_2') error @enderror"
                                        value="{{ session('Data.company_nature') == 'B' ? $MobileData->parent_mobile_2 : $MobileData->student_mobile_2 }}"
                                        placeholder="923001234567">
                                    <label for="student_mobile_2">Secondary Mobile Number *</label>
                                    @error('student_mobile_2')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col s12 m6 l6">
                                    <label class="m-t-20">Date of Birth</label>
                                    <div class="input-fleid">
                                        <input type="text" value="{{ $MobileData->dob }}" id="dob" name="dob"
                                            placeholder="01/01/1999">
                                    </div>
                                    @error('dob')
                                        <span style="color: rgb(255, 0, 0)">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="cnic" name="cnic" type="text" class="@error('cnic') error @enderror"
                                        value="{{ $MobileData->cnic }}" placeholder="35201-1234567-8">
                                    <label for="cnic">CNIC *</label>
                                    @error('cnic')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                <div class="col s6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" name="gender" id="gender">
                                        <option>Select</option>
                                        <option value="M" {{ $MobileData->gender == 'M' ? ' selected' : '' }}>Male
                                        </option>
                                        <option value="F" {{ $MobileData->gender == 'F' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    @error('gender')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col s6">
                                    <label for="active" class="form-label">Status</label>
                                    <select class="form-select" name="active" id="active">
                                        <option>Select</option>
                                        <option value="Y" {{ $MobileData->active == 'Y' ? ' selected' : '' }}>Active
                                        </option>
                                        <option value="N" {{ $MobileData->active == 'N' ? 'selected' : '' }}>Not Active
                                        </option>
                                    </select>
                                    @error('active')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if (session('Data.company_nature') == 'S')
                                    <div class="m-t-20 col s12 m12 l12">
                                        <hr>
                                        <h3 class="card-title">Parents</h3>
                                    </div>

                                    <div class="input-field col s12 m6 l6">
                                        <i class="material-icons prefix">text_format</i>
                                        <input id="parent_first_name" name="parent_first_name" type="text"
                                            class="@error('parent_first_name') error @enderror"
                                            value="{{ $MobileData->parent_first_name }}">
                                        <label for="parent_first_name">First Name *</label>
                                        @error('parent_first_name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-field col s12 m6 l6">
                                        <i class="material-icons prefix">text_format</i>
                                        <input id="parent_last_name" name="parent_last_name" type="text"
                                            class="@error('parent_last_name') error @enderror"
                                            value="{{ $MobileData->parent_last_name }}">
                                        <label for="parent_last_name">Last Name *</label>
                                        @error('parent_last_name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-field col s12 m6 l6">
                                        <i class="material-icons prefix">text_format</i>
                                        <input id="parent_mobile_1" name="parent_mobile_1" type="text"
                                            class="@error('parent_mobile_1') error @enderror"
                                            value="{{ $MobileData->parent_mobile_1 }}" placeholder="923001234567">
                                        <label for="parent_mobile_1">Primary Mobile Number *</label>
                                        @error('parent_mobile_1')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-field col s12 m6 l6">
                                        <i class="material-icons prefix">text_format</i>
                                        <input id="parent_mobile_2" name="parent_mobile_2" type="text"
                                            class="@error('parent_mobile_2') error @enderror"
                                            value="{{ $MobileData->parent_mobile_2 }}" placeholder="923001234567">
                                        <label for="parent_mobile_2">Secondary Mobile Number *</label>
                                        @error('parent_mobile_2')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="input-field m-t-20 col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Save
                                    </button>
                                    <a href="{{ route('data.index') }}"
                                        class="btn waves-effect red waves-light right m-r-10">Back
                                        to
                                        {{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}
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
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>

    {{-- <script src="{{asset('assets/extra-libs/prism/prism.js')}}"></script> --}}
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script
        src="{{ asset('assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js') }}">
    </script>
    <script>
        $('#dob').bootstrapMaterialDatePicker({
            // format: 'DD/MM/YYYY',
            weekStart: 1,
            time: false
        });

        $('#group').on('change', function() {

            var GroupId = $(this).val();

            var Data = "";

            $.ajax({
                type: "get",
                url: '/sections/' + GroupId + '/list',
                dataType: 'json',
                success: function(response) {

                    Data += '<option value="">Select</option>';
                    for (let index = 0; index < response.length; index++) {
                        Data += '<option value="' + response[index].id + '">' + response[index].name +
                            '</option>\n';
                    }
                    $('#section').html(Data);

                    var elem = document.querySelector('#section');
                    var instance = M.FormSelect.init(elem);

                }
            });

        });
    </script>
@endsection
