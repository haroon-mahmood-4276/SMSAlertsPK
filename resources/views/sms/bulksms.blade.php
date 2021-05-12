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
        <div class="page-titles m-b-15">
            <div class="d-flex align-items-center">
                <h3 class="font-medium m-b-0">Bulk SMS</h3>
                {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">Messaging</a>
                    <a href="{{ route('r.bulksmsshow') }}" class="breadcrumb">Bulk SMS</a>
                </div>
            </div>
        </div>
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <form class="formValidate" id="formValidate" action="{{ route('r.bulksms') }}" method="POST">
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
                                    <select class="form-select" name="group" id="group">
                                        <option value="0">All</option>
                                        @foreach ($Groups as $Group)
                                            <option value="{{ $Group->id }}">{{ $Group->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="group" class="form-label">Group</label>
                                    @error('group')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s6">
                                    <select class="form-select" name="section" id="section">
                                        <option value="0">All</option>
                                        {{-- @foreach ($Sections as $Section)
                                            <option value="{{ $Section->id }}">{{ $Section->name }}</option>
                                        @endforeach --}}
                                    </select>
                                    <label for="section" class="form-label">Section</label>
                                    @error('section')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12">
                                    <select class="form-select" name="template" id="template">
                                        <option value="0">Select</option>
                                        @foreach ($Templates as $Template)
                                            <option value="{{ $Template->id }}">{{ $Template->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="template" class="form-label">Template</label>
                                    @error('template')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m12 l12">
                                    <i class="material-icons prefix">question_answer</i>
                                    <label for="message">Message *</label>
                                    <textarea id="message" name="message"
                                        class="materialize-textarea @error('message') error @enderror"
                                        value="{{ old('message') }}"></textarea>
                                    @error('message')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field m-t-10 col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Submit
                                    </button>
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

    {{-- <script src="{{asset('assets/extra-libs/prism/prism.js')}}"></script> --}}
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script
        src="{{ asset('assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js') }}">
    </script>
    <script>
        $('#DOB').bootstrapMaterialDatePicker({
            format: 'DD/MM/YYYY',
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
                    Data += '<option value="">All</option>';
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

        $('#template').on('change', function() {
            var TemplateId = $(this).val();
            $.ajax({
                type: "get",
                url: '/templates/' + TemplateId,
                dataType: 'json',
                success: function(response) {
                    $('#message').val(response.template);
                }
            });

        });

    </script>
@endsection
