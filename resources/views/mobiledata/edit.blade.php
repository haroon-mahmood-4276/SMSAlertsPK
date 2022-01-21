@extends('shared.layout')

@section('PageTitle', 'Edit ' . (@(session('Data.company_nature') == 'B') ? 'Member' : 'Student'))

@section('CSS')

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
                        <form action="{{ route('data.update', ['data' => encryptParams($mobiledata->id)]) }}" method="POST" id="update-member-form" >
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
                                        @foreach ($groups as $group)
                                            <option value="{{ $group->id }}"
                                                {{ $group->id == $mobiledata->group_id ? 'selected' : '' }}>{{ $group->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="group"
                                        class="form-label">{{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}</label>
                                    @error('group')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                    <div class="input-field col s6">
                                        <select class="form-select" name="section" id="section">
                                            <option value="">Select</option>
                                            @foreach ($sections as $section)
                                                <option value="{{ $section->id }}"
                                                    {{ $section->id == $mobiledata->section_id ? 'selected' : '' }}>{{ $section->name }}
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
                                        value="{{ $mobiledata->code }}" disabled>
                                    <label for="code">Code *</label>
                                    @error('code')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="student_first_name" name="student_first_name" type="text"
                                        class="@error('student_first_name') error @enderror"
                                        value="{{ $mobiledata->student_first_name }}">
                                    <label for="student_first_name">First Name *</label>
                                    @error('student_first_name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="student_last_name" name="student_last_name" type="text"
                                        class="@error('student_last_name') error @enderror"
                                        value="{{ $mobiledata->student_last_name }}">
                                    <label for="student_last_name">Last Name *</label>
                                    @error('student_last_name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="student_mobile_1" name="student_mobile_1" type="text"
                                        class="@error('student_mobile_1') error @enderror"
                                        value="{{ session('Data.company_nature') == 'B' ? $mobiledata->parent_mobile_1 : $mobiledata->student_mobile_1 }}"
                                        placeholder="923001234567">
                                    <label for="student_mobile_1">Primary Mobile Number *</label>
                                     @error('student_mobile_1')
                                        <span style="color: red">{{ $message }}</span>
                                    @else
                                        <span style="color: red">&nbsp;</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="student_mobile_2" name="student_mobile_2" type="text"
                                        class="@error('student_mobile_2') error @enderror"
                                        value="{{ session('Data.company_nature') == 'B' ? $mobiledata->parent_mobile_2 : $mobiledata->student_mobile_2 }}"
                                        placeholder="923001234567">
                                    <label for="student_mobile_2">Secondary Mobile Number</label>
                                     @error('student_mobile_2')
                                        <span style="color: red">{{ $message }}</span>
                                    @else
                                        <span style="color: red">&nbsp;</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <input type="text" value="{{ $mobiledata->dob }}" id="dob" name="dob"
                                        placeholder="01/01/1999">
                                    <label class="form-label">Date of Birth</label>
                                    @error('dob')
                                        <span style="color: rgb(255, 0, 0)">{{ $message }}</span>
                                    @enderror
                                </div>
                                {{-- <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="cnic" name="cnic" type="text" class="@error('cnic') error @enderror"
                                        value="{{ $mobiledata->cnic }}" placeholder="35201-1234567-8">
                            <label for="cnic">CNIC *</label>
                            @error('cnic')
                            <span style="color: red">{{ $message }}</span>
                            @enderror
                        </div> --}}

                                <div class="input-field col s12 m6 l6">
                                    <select class="form-select" name="gender" id="gender">
                                        <option value="">Select</option>
                                        <option value="M" {{ $mobiledata->gender == 'M' ? ' selected' : '' }}>Male
                                        </option>
                                        <option value="F" {{ $mobiledata->gender == 'F' ? 'selected' : '' }}>Female
                                        </option>
                                    </select>
                                    <label for="gender" class="form-label">Gender</label>
                                    @error('gender')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <select class="form-select" name="active" id="active">
                                        <option value="">Select</option>
                                        <option value="Y" {{ $mobiledata->active == 'Y' ? ' selected' : '' }}>Active
                                        </option>
                                        <option value="N" {{ $mobiledata->active == 'N' ? 'selected' : '' }}>Not Active
                                        </option>
                                    </select>
                                    <label for="active" class="form-label">Status</label>
                                    @error('active')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="card_number" name="card_number" type="text"
                                        class="@error('card_number') error @enderror"
                                        value="{{ $mobiledata->card_number }}">
                                    <label for="card_number">Device Card Number (if any)</label>
                                    @error('card_number')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                    <div class="m-t-20 col s12 m12 l12">
                                        <hr>
                                        <h3 class="card-title">Parents</h3>
                                    </div>

                                    <div class="input-field col s12 m6 l6">
                                        <i class="material-icons prefix">text_format</i>
                                        <input id="parent_first_name" name="parent_first_name" type="text"
                                            class="@error('parent_first_name') error @enderror"
                                            value="{{ $mobiledata->parent_first_name }}">
                                        <label for="parent_first_name">First Name *</label>
                                        @error('parent_first_name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-field col s12 m6 l6">
                                        <i class="material-icons prefix">text_format</i>
                                        <input id="parent_last_name" name="parent_last_name" type="text"
                                            class="@error('parent_last_name') error @enderror"
                                            value="{{ $mobiledata->parent_last_name }}">
                                        <label for="parent_last_name">Last Name *</label>
                                        @error('parent_last_name')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-field col s12 m6 l6">
                                        <i class="material-icons prefix">text_format</i>
                                        <input id="parent_mobile_1" name="parent_mobile_1" type="text"
                                            class="@error('parent_mobile_1') error @enderror"
                                            value="{{ $mobiledata->parent_mobile_1 }}" placeholder="923001234567">
                                        <label for="parent_mobile_1">Primary Mobile Number *</label>
                                        @error('parent_mobile_1')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>

                                    <div class="input-field col s12 m6 l6">
                                        <i class="material-icons prefix">text_format</i>
                                        <input id="parent_mobile_2" name="parent_mobile_2" type="text"
                                            class="@error('parent_mobile_2') error @enderror"
                                            value="{{ $mobiledata->parent_mobile_2 }}" placeholder="923001234567">
                                        <label for="parent_mobile_2">Secondary Mobile Number</label>
                                        @error('parent_mobile_2')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="input-field m-t-20 col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Update
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
    <script>
         $(document).ready(function() {
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
                            Data += '<option value="' + response[index].id + '">' + response[
                                    index].name +
                                '</option>\n';
                        }
                        $('#section').html(Data);
                        var elem = document.querySelector('#section');
                        var instance = M.FormSelect.init(elem);
                    }
                });
            });

            $("#update-member-form").validate({

                rules: {
                    group: {
                        required: true,
                    },
                    section: {
                        required: function(element) {
                            return '{{ session('Data.company_nature') }}' == 'S' ||
                                '{{ session('Data.company_nature') }}' == 'HE';
                        },
                    },
                    student_first_name: {
                        required: true,
                        minlength: 2,
                        maxlength: 50,
                    },
                    student_last_name: {
                        required: true,
                        minlength: 2,
                        maxlength: 50,
                    },
                    student_mobile_1: {
                        required: true,
                        digits: true,
                        minlength: 11,
                        maxlength: 12,
                    },
                    student_mobile_2: {
                        digits: true,
                        minlength: 11,
                        maxlength: 12,
                    },
                    dob: {
                        required: true,
                    },
                    gender: {
                        required: true,
                    },
                    active: {
                        required: true,
                    },
                    card_number: {
                        digits: true,
                    },
                    parent_first_name: {
                        required: function(element) {
                            return '{{ session('Data.company_nature') }}' == 'S' ||
                                '{{ session('Data.company_nature') }}' == 'HE';
                        },
                    },
                    parent_last_name: {
                        required: function(element) {
                            return '{{ session('Data.company_nature') }}' == 'S' ||
                                '{{ session('Data.company_nature') }}' == 'HE';
                        },
                    },
                    parent_mobile_1: {
                        required: function(element) {
                            return '{{ session('Data.company_nature') }}' == 'S' ||
                                '{{ session('Data.company_nature') }}' == 'HE';
                        },
                    },
                    parent_mobile_2: {
                        required: function(element) {
                            return '{{ session('Data.company_nature') }}' == 'S' ||
                                '{{ session('Data.company_nature') }}' == 'HE';
                        },
                    },
                },
                validClass: "success",
                errorClass: 'error',
                errorElement: "span",
                wrapper: "div",
                submitHandler: function(form) {
                    Swal.fire({
                        allowOutsideClick: false,
                        showConfirmButton: true,
                        showDenyButton: true,
                        allowEscapeKey: true,
                        allowEnterKey: true,
                        buttonsStyling: false,
                        title: "Do you want to update this {{ session('Data.company_nature') == 'B' ? 'Member' : 'Student' }}?",
                        backdrop: true,
                        confirmButtonText: 'Yes',
                        denyButtonText: 'No',
                        customClass: {
                            popup: 'rounded-5 p-t-3',
                            confirmButton: 'btn btn-primary m-10',
                            denyButton: 'btn btn-small waves-effect red waves-light m-10',
                        }
                    }).then(function(dialogue) {
                        if (dialogue.isConfirmed) {
                            form.submit();
                        }
                    });
                }
            });
        });
    </script>
@endsection
