@extends('shared.layout')

@section('PageTitle', 'Create ' . @(session('Data.company_nature') == 'B') ? 'Member' : 'Student')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Create
                            {{ session('Data.company_nature') == 'B' ? 'Member' : 'Student' }}
                        </h5>
                        <form action="{{ route('data.store') }}" method="POST">
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
                                <div class="input-field col s6">
                                    <select class="form-select" name="company_nature" id="company_nature">
                                        <option value="">Select</option>
                                        <option value="B">Business User</option>
                                        <option value="S">School User</option>
                                    </select>
                                    <label for="company_nature" class="form-label">Group</label>
                                    @error('company_nature')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="code" name="code" type="text" class="@error('code') error @enderror"
                                        value="{{ old('code') }}">
                                    <label for="code">Code *</label>
                                    @error('code')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="first_name" name="first_name" type="text"
                                        class="@error('first_name') error @enderror" value="{{ old('first_name') }}">
                                    <label for="first_name">First Name *</label>
                                    @error('first_name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="last_name" name="last_name" type="text"
                                        class="@error('last_name') error @enderror" value="{{ old('last_name') }}">
                                    <label for="last_name">Last Name *</label>
                                    @error('last_name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="mobile_1" name="mobile_1" type="text"
                                        class="@error('mobile_1') error @enderror" value="{{ old('mobile_1') }}"
                                        placeholder="923001234567">
                                    <label for="mobile_1">Primary Mobile Number *</label>
                                    @error('mobile_1')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="mobile_2" name="mobile_2" type="text"
                                        class="@error('mobile_2') error @enderror" value="{{ old('mobile_2') }}"
                                        placeholder="923001234567">
                                    <label for="mobile_2">Secondary Mobile Number *</label>
                                    @error('mobile_2')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col s12 m6 l6">
                                    <label class="m-t-20">Date of Birth</label>
                                    <div class="input-fleid">
                                        <input type="text" value="{{ old('dob') }}" id="dob" name="dob"
                                            placeholder="1999-01-01">
                                    </div>
                                    @error('dob')
                                        <span style="color: rgb(255, 0, 0)">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="cnic" name="cnic" type="text" class="@error('cnic') error @enderror"
                                        value="{{ old('cnic') }}" placeholder="35201-1234567-8">
                                    <label for="cnic">CNIC *</label>
                                    @error('cnic')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div> --}}

                                <div class="col s6">
                                    <label for="gender" class="form-label">Gender</label>
                                    <select class="form-select" name="gender" id="gender">
                                        <option>Select</option>
                                        <option value="M" {{ old('gender') == 'M' ? ' selected' : '' }}>Male
                                        </option>
                                        <option value="F" {{ old('gender') == 'F' ? 'selected' : '' }}>Female
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
                                        <option value="Y" {{ old('active') == 'Y' ? ' selected' : '' }}>Active</option>
                                        <option value="N" {{ old('active') == 'N' ? 'selected' : '' }}>Not Active
                                        </option>
                                    </select>
                                    @error('active')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field m-t-20 col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Submit
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
    <script src="{{ asset('dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>

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

        // $('#group').on('change', function() {

        //     var GroupId = $(this).val();

        //     var Data = "";

        //     $.ajax({
        //         type: "get",
        //         url: '/sections/' + GroupId + '/list',
        //         dataType: 'json',
        //         success: function(response) {

        //             Data += '<option value="">Select</option>';
        //             for (let index = 0; index < response.length; index++) {
        //                 Data += '<option value="' + response[index].id + '">' + response[index].name +
        //                     '</option>\n';
        //             }
        //             $('#section').html(Data);

        //             var elem = document.querySelector('#section');
        //             var instance = M.FormSelect.init(elem);

        //         }
        //     });

        // });
    </script>
@endsection
