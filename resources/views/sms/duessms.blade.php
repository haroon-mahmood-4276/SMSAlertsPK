@extends('shared.layout')

@section('PageTitle', 'Dues SMS')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
    <link href="{{ asset('dist/css/pages/email.css') }}" rel="stylesheet">
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-titles">
            <div class="d-flex align-items-center">
                <h3 class="font-medium">Dues SMS</h3>
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">Messaging</a>
                    <a href="{{ route('r.smsdues') }}" class="breadcrumb">Dues SMS</a>
                </div>
            </div>
        </div>
        <div class="container-fluid row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        @if (Session::has('AlertType') && Session::has('AlertMsg'))
                            <div class="row">
                                <div class="col l12 m12 s12 m-5">
                                    <div class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                                        {{ Session::get('AlertMsg') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <form class="formValidate" id="formValidate"
                            action="{{ route('r.duessms', ['asd' => $DuesData ?? '']) }}" method="POST"
                            enctype="multipart/form-data">
                            @csrf
                            <div class="row">

                                <div class="input-field col s12 m6" style="margin-top: 60px !important;">
                                    <select class="form-select" name="template" id="template">
                                        <option value="">Select</option>
                                        @foreach ($Templates as $Template)
                                            <option value="{{ $Template->id }}"
                                                {{ $Template->id == $Template_Code ? 'selected' : '' }}>
                                                {{ $Template->name }}
                                            </option>
                                        @endforeach
                                    </select>
                                    <label for="template" class="form-label">Template</label>
                                    @error('template')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12 m6">
                                    <p>Don't have sample file? Download <a href="{{ route('r.csvdues') }}">.csv
                                            file</a> or <a href="{{ route('r.xlsdues') }}">.xls file</a>.
                                    </p>
                                    <div class="row">
                                        <div class="col s12">
                                            <div class="file-field input-field col s10">
                                                <div class="btn">
                                                    <span>File</span>
                                                    <input type="file" name="duesfile">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Please upload only .csv or .xls document">
                                                </div>
                                            </div>
                                            <div class="input-field col s2">
                                                <button class="btn pulse blue waves-effect waves-light" type="submit"
                                                    name="fileupload" value="fileupload"><i
                                                        class="material-icons">file_upload</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-field col s12">
                                    <i class="material-icons prefix">question_answer</i>
                                    <label for="message">Message *</label>
                                    <textarea id="message" name="message"
                                        class="materialize-textarea count-message-character @error('message') error @enderror">{{ $Message }}</textarea>
                                    <span class="character-counter" id="message-character-counter"
                                        style="float: right; font-size: 12px;"> &nbsp;</span>
                                    @error('message')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col s12 m12 l12 m-b-20">
                                    <p><strong>Tags</strong></p>
                                    <div class="row">
                                        <div class="col s6 m3 l2 m-2">
                                            <a href="javascript:void(0)" id="student_full_name" onmouseup="textbox(this.id)"
                                                class="chip">Student Full Name</a>
                                        </div>

                                        <div class="col s6 m3 l2 m-2">
                                            <a href="javascript:void(0)" id="class_name" onmouseup="textbox(this.id)"
                                                class="chip">Class Name</a>
                                        </div>
                                        <div class="col s6 m3 l2 m-2">
                                            <a href="javascript:void(0)" id="section_name" onmouseup="textbox(this.id)"
                                                class="chip">Section Name</a>
                                        </div>
                                        <div class="col s6 m3 l2 m-2">
                                            <a href="javascript:void(0)" id="school_name" onmouseup="textbox(this.id)"
                                                class="chip">School Name</a>
                                        </div>
                                        <div class="col s6 m3 l2 m-2">
                                            <a href="javascript:void(0)" id="school_phone_1" onmouseup="textbox(this.id)"
                                                class="chip">School Phone No 1</a>
                                        </div>
                                        <div class="col s6 m3 l2 m-2">
                                            <a href="javascript:void(0)" id="school_phone_2" onmouseup="textbox(this.id)"
                                                class="chip">School Phone No 2</a>
                                        </div>
                                        <div class="col s6 m3 l2 m-2">
                                            <a href="javascript:void(0)" id="school_email" onmouseup="textbox(this.id)"
                                                class="chip">School Email</a>
                                        </div>
                                        <div class="col s6 m3 l2 m-2">
                                            <a href="javascript:void(0)" id="dues" onmouseup="textbox(this.id)"
                                                class="chip">Dues</a>
                                        </div>
                                    </div>
                                </div>

                                <div class="input-field m-t-10 col s12" id="SDTTable">
                                    <table id="demo-foo-addrow2"
                                        class="table m-b-0 toggle-arrow-tiny centered responsive-table" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <td>Code</td>
                                                <td>Name</td>
                                                <td data-sort-initial="true" data-toggle="true">Class - Section</td>
                                                <td>Parent Name</td>
                                                <td>Parent Primary Number</td>
                                                <td>Parent Secondary Number</td>
                                                <td>Student Primary Number</td>
                                                <td>Student Secondary Number</td>
                                                <td>Dues</td>
                                                <td>Stauts</td>
                                                <td>Actions</td>
                                            </tr>
                                        </thead>
                                        <div class="">
                                            <div class="d-flex">
                                                <div class="ml-auto">
                                                    <div class="form-group">
                                                        <input id="demo-input-search2" type="text" placeholder="Search"
                                                            autocomplete="off">
                                                        <p>
                                                            <label>
                                                                <input type="checkbox" class="sl-all filled-in" />
                                                                <span>Check All</span>
                                                            </label>
                                                        </p>

                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <tbody>
                                            @foreach ($DuesData as $Data)
                                                <tr>
                                                    <td>{{ $Data[0]->code }}</td>
                                                    <td>{{ $Data[0]->student_first_name }}
                                                        {{ $Data[0]->student_last_name }}</td>
                                                    <td>{{ $Data[0]->group_name }} -
                                                        {{ $Data[0]->section_name }}</td>
                                                    <td>{{ $Data[0]->parent_first_name }}
                                                        {{ $Data[0]->parent_last_name }}</td>
                                                    <td>{{ $Data[0]->parent_mobile_1 }}</td>
                                                    <td>{{ $Data[0]->parent_mobile_2 }}</td>
                                                    <td>{{ $Data[0]->student_mobile_1 }}</td>
                                                    <td>{{ $Data[0]->student_mobile_2 }}</td>
                                                    <td>{{ $Data['dues'] }}</td>
                                                    <td>
                                                        @if ($Data[0]->active == 'Y')
                                                            <span class="label label-table label-success">Active</span>
                                                        @else
                                                            <span class="label label-table label-danger">Not Active</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <p><label><input type='checkbox' name="{{ $Data[0]->id }}chk"
                                                                    class='chkbox filled-in' /><span>SMS</span></label></p>
                                                    </td>
                                                </tr>
                                            @endforeach
                                        </tbody>
                                        <tfoot>
                                            <tr>
                                                <td colspan="11">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-split"> </ul>
                                                    </div>
                                                </td>
                                            </tr>
                                        </tfoot>
                                    </table>
                                </div>

                                <div class="col s12 m-t-25">
                                    <p><strong>SMS To</strong></p>
                                    <div class="row">
                                        <div class="col s12 m6 l3">
                                            <p>
                                                <label>
                                                    <input type="checkbox" id="parent_primary_number" class="filled-in"
                                                        name="parent_primary_number" checked disabled />
                                                    <span>Parent Primary Number</span>
                                                </label>
                                            </p>
                                        </div>

                                        <div class="col s12 m6 l3">
                                            <p>
                                                <label>
                                                    <input type="checkbox" id="parent_secondary_number" class="filled-in"
                                                        name="parent_secondary_number" />
                                                    <span>Parent Secondary Number</span>
                                                </label>
                                            </p>
                                        </div>
                                        @if (session('Data.company_nature') == 'S')
                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="student_primary_number" class="filled-in"
                                                            name="student_primary_number" />
                                                        <span>Student Primary Number</span>
                                                    </label>
                                                </p>
                                            </div>
                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="student_secondary_number"
                                                            class="filled-in" name="student_secondary_number" />
                                                        <span>Student Secondary Number</span>
                                                    </label>
                                                </p>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit" name="action"
                                        value="submit">Send SMS
                                    </button>
                                    <button class="btn waves-effect red waves-light right m-r-10 reset"
                                        type="reset">Reset</button>
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
    <script src="{{ asset('assets/libs/footable/dist/footable.all.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/footable/footable-init.js') }}"></script>

    <script>
        $('#template').on('change', function() {
            var TemplateId = $(this).val();
            $.ajax({
                type: "get",
                url: "{{ route('templates.show', ['template' => ':id']) }}".replace(':id',
                    TemplateId),
                dataType: 'json',
                success: function(response) {
                    $('#message').val(response.template);
                }
            });
        });

        $('.reset').on('click', function() {
            $("#demo-foo-addrow2 > tbody > tr").remove();
        });

        $(".sl-all").on('click', function() {
            $('.chkbox').prop('checked', this.checked);
        });
    </script>
    <script type="text/javascript">
        function textbox(Element) {
            var ctl = document.getElementById('message');
            var EndPosition = ctl.selectionEnd;
            ctl.value = [ctl.value.slice(0, EndPosition), "[" + Element + "]", ctl.value.slice(EndPosition, ctl.value
                .length)].join('');
            ctl.focus();
        }
    </script>
@endsection
