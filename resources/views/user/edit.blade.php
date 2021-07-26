@extends('shared.layout')

@section('PageTitle', 'Create User')

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
                        <h5 class="card-title">Create User
                        </h5>
                        <form action="{{ route('users.store') }}" method="POST">
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

                                <div class="input-field col s12 m12 l12">
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
                                    <input id="email" name="email" type="email" class="@error('email') error @enderror"
                                        value="{{ old('email') }}">
                                    <label for="email">Email*</label>
                                    @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="password" name="password" type="password"
                                        class="@error('password') error @enderror" value="{{ old('password') }}">
                                    <label for="password">Password *</label>
                                    @error('password')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="m-t-20 col s12 m12 l12">
                                    <hr>
                                    <h3 class="card-title">Company Details</h3>
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="company_name" name="company_name" type="text"
                                        class="@error('company_name') error @enderror" value="{{ old('company_name') }}">
                                    <label for="company_name">Company Name*</label>
                                    @error('company_name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="company_mask_id" name="company_mask_id" type="text"
                                        class="@error('company_mask_id') error @enderror"
                                        value="{{ old('company_mask_id') }}">
                                    <label for="company_mask_id">Company Mask ID *</label>
                                    @error('company_mask_id')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="company_username" name="company_username" type="text"
                                        class="@error('company_username') error @enderror"
                                        value="{{ old('company_username') }}">
                                    <label for="company_username">Company Username*</label>
                                    @error('company_username')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="company_password" name="company_password" type="password"
                                        class="@error('company_password') error @enderror"
                                        value="{{ old('company_password') }}">
                                    <label for="company_password">Company Password *</label>
                                    @error('company_password')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="company_email" name="company_email" type="email"
                                        class="@error('company_email') error @enderror"
                                        value="{{ old('company_email') }}">
                                    <label for="company_email">Company Email*</label>
                                    @error('company_email')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <select class="form-select" name="company_nature" id="company_nature">
                                        <option value="">Select</option>
                                        <option value="B" {{ old('company_nature') == 'B' ? 'selected' : '' }}>Business User
                                        </option>
                                        <option value="S" {{ old('company_nature') == 'S' ? 'selected' : '' }}>School User
                                        </option>
                                    </select>
                                    <label for="company_nature" class="form-label">Group</label>
                                    @error('company_nature')
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

                                <div class="input-field m-t-20 col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Submit
                                    </button>
                                    <a href="{{ route('users.index') }}"
                                        class="btn waves-effect red waves-light right m-r-10">Back to Users List</a>
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
@endsection
