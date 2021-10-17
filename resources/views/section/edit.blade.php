@extends('shared.layout')

@section('PageTitle', 'Edit Section')

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
                        <h5 class="card-title">Create Section</h5>
                        <form action="{{ route('sections.update', ['section' => $Section->id]) }}" class="formValidate"
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
                            <div class="input-field col s12">
                                <i class="material-icons prefix">text_format</i>
                                <select class="form-select" name="class" id="class">
                                    <option value="">Select</option>
                                    @foreach ($Groups as $Group)
                                        <option value="{{ $Group->id }}"
                                            {{ $Group->id == $Section->group_id ? 'selected' : '' }}>{{ $Group->name }}
                                        </option>
                                    @endforeach
                                </select>
                                <label for="class" class="form-label">Classes</label>
                                @error('class')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12">
                                <i class="material-icons prefix">text_format</i>
                                <input id="code" name="code" type="text" class="@error('code') error @enderror"
                                    value="{{ $Section->code }}" maxlength="5">
                                <label for="code">Section ID *</label>
                                @error('code')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="input-field col s12">
                                <label for="name" class="form-label">Section Name</label>
                                <input type="text" name="name" class="form-control @error('name') is-invalid @enderror"
                                    id="name" value="{{ $Section->name }}" placeholder="Section Name">
                                @error('name')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Save
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
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
@endsection
