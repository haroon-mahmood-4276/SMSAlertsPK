@extends('shared.layout')

@section('PageTitle', 'Create ' . @(session('Data.company_nature') == 'B') ? 'Groups' : 'Classes')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
@endsection

@section('content')
    <div class="page-wrapper ">
        <div class="container-fluid row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Create
                            {{ session('Data.company_nature') == 'B' ? 'Group' : 'Class' }}</h5>
                        <form class="formValidate" id="formValidate" action="{{ route('groups.store') }}" method="POST">
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
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="code" name="code" type="text" class="@error('code') error @enderror"
                                        value="{{ old('code') }}" maxlength="5">
                                    <label for="code">{{ session('Data.company_nature') == 'B' ? 'Group' : 'Class' }} ID
                                        *</label>
                                    @error('code')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                                <div class="input-field col s12">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="name" name="name" type="text" class="@error('name') error @enderror"
                                        value="{{ old('name') }}">
                                    <label for="name">{{session('Data.company_nature') == 'B' ? 'Group' : 'Class'}} Name *</label>
                                    @error('name')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Save
                                    </button>
                                    <a href="{{ route('groups.index') }}"
                                        class="btn waves-effect red waves-light right m-r-10">Back to
                                        {{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}
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

    <script src="{{ asset('assets/extra-libs/prism/prism.js') }}"></script>

@endsection
