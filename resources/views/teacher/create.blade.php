@extends('shared.layout')

@section('PageTitle', 'Create Teacher')

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
                        <h5 class="card-title">Create Teacher
                        </h5>
                        <form action="{{ route('teachers.store') }}" method="POST">
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

                                <div class="col s12 m12 l12">
                                    <div class="row">
                                        <div class="input-field col s12 m6 l6">
                                            <i class="material-icons prefix">text_format</i>
                                            <input id="code" name="code" type="text" class="@error('code') error @enderror"
                                                value="{{ old('code') }}">
                                            <label for="code">Code *</label>
                                            @error('code')
                                                <span style="color: red">{{ $message }}</span>
                                            @enderror
                                        </div>
                                    </div>
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="first_name" name="first_name" type="text"
                                        class="@error('first_name') error @enderror" value="{{ old('first_name') }}">
                                    <label for="first_name">First Name *</label>
                                    @error('first_name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="last_name" name="last_name" type="text"
                                        class="@error('last_name') error @enderror" value="{{ old('last_name') }}">
                                    <label for="last_name">Last Name *</label>
                                    @error('last_name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="email" name="email" type="email" class="@error('email') error @enderror"
                                        value="{{ old('email') }}">
                                    <label for="email">Email*</label>
                                    @error('email')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="password" name="password" type="password"
                                        class="@error('password') error @enderror" value="{{ old('password') }}">
                                    <label for="password">Password *</label>
                                    @error('password')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="mobile_1" name="mobile_1" type="text"
                                        class="@error('mobile_1') error @enderror" value="{{ old('mobile_1') }}"
                                        placeholder="923001234567">
                                    <label for="mobile_1">Primary Mobile Number *</label>
                                    @error('mobile_1')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="mobile_2" name="mobile_2" type="text"
                                        class="@error('mobile_2') error @enderror" value="{{ old('mobile_2') }}"
                                        placeholder="923001234567">
                                    <label for="mobile_2">Secondary Mobile Number *</label>
                                    @error('mobile_2')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="coodinator_number" name="coodinator_number" type="text"
                                        class="@error('coodinator_number') error @enderror"
                                        value="{{ old('coodinator_number') }}" placeholder="923001234567">
                                    <label for="coodinator_number">Coodinator Number *</label>
                                    @error('coodinator_number')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6 l6">
                                    <select class="form-select" name="active" id="active">
                                        <option value="">Select</option>
                                        <option value="Y" {{ old('active') == 'Y' ? ' selected' : '' }}>Active</option>
                                        <option value="N" {{ old('active') == 'N' ? 'selected' : '' }}>Not Active
                                        </option>
                                    </select>
                                    <label for="active" class="form-label">Status</label>
                                    @error('active')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field m-t-20 col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Save
                                    </button>
                                    <a href="{{ route('teachers.index') }}"
                                        class="btn waves-effect red waves-light right m-r-10">Back to Teachers List</a>
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

@endsection
