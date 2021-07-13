@extends('shared.layout')

@section('PageTitle', 'Create Section')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title activator">Create Section</h5>
                        <form action="{{ route('sections.store') }}" class="formValidate" id="formValidate" method="POST">
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
                            <div class="input-field col s12">
                                <i class="material-icons prefix">text_format</i>
                                <select class="form-select" name="group_name" id="group_name">
                                    <option value="">Select</option>
                                    @foreach ($Groups as $Group)
                                    <option value="{{ $Group->id }}">{{ $Group->name }}</option>
                                    @endforeach
                                </select>
                                <label for="group_name" class="form-label">Group</label>
                                @error('group_name')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">text_format</i>
                                <input id="code" name="code" type="text" class="@error('code') error @enderror"
                                    value="{{ old('code') }}" maxlength="5">
                                <label for="code">Section ID *</label>
                                @error('code')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">text_format</i>
                                <label for="name" class="form-label">Section Name</label>
                                <input type="text" name="name"
                                    class="form-control validate @error('name') is-invalid @enderror" id="name"
                                    value="{{ old('name') }}">
                                @error('name')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Submit
                                    </button>
                                    <a href="{{ route('sections.index') }}"
                                        class="btn waves-effect red waves-light right m-r-10">Back to Section
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

@endsection
