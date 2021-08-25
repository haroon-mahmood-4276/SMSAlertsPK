@extends('shared.layout')

@section('PageTitle', 'Create Subject')

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
                        <h5 class="card-title">Create Subject</h5>
                        <form action="{{ route('subjects.store') }}" class="formValidate" id="formValidate" method="POST">
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

                            <div class="input-field col s12 m6 l6">
                                <select class="form-select" name="group" id="group">
                                    <option value="">Select</option>
                                    @foreach ($Groups as $Group)
                                        <option value="{{ $Group->id }}">{{ $Group->name }}</option>
                                    @endforeach
                                </select>
                                <label for="group" class="form-label">Classes</label>
                                @error('group')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <select class="form-select" name="section" id="section">
                                    <option value="">Select</option>
                                </select>
                                <label for="section" class="form-label">Section</label>
                                @error('section')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">text_format</i>
                                <input id="code" name="code" type="text" class="@error('code') error @enderror"
                                    value="{{ old('code') }}" maxlength="5">
                                <label for="code">Code *</label>
                                @error('code')
                                    <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">text_format</i>
                                <label for="name" class="form-label">Name</label>
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
                                        name="action">Save
                                    </button>
                                    <a href="{{ route('sections.index') }}"
                                        class="btn waves-effect red waves-light right m-r-10">Back to Subject
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
    <script>
        $('#group').on('change', function() {
            var GroupId = ($(this).val()) ? $(this).val() : '0';
            var Data = '<option value="">Select</option>';
            $.ajax({
                type: "get",
                url: "{{ route('r.sectionlist', ['section' => ':id']) }}".replace(':id', GroupId),
                dataType: 'json',
                success: function(response) {
                    for (let index = 0; index < response.length; index++) {
                        Data += '<option value="' + response[index].id + '">' + response[index].name +
                            '</option>';
                    }
                    $('#section').html(Data);
                    M.FormSelect.init(document.querySelector('#section'));
                }
            });
            $('#section').html(Data);
            M.FormSelect.init(document.querySelector('#section'));
        });
    </script>

@endsection
