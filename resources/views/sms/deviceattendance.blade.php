@extends('shared.layout')

@section('PageTitle', 'Device Attendance')

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
            <h3 class="font-medium">Device Attendance</h3>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                <a href="javascript:void(0)" class="breadcrumb">Attendance System.</a>
                <a href="{{ route('r.device-attendance-view') }}" class="breadcrumb">Device Attendance</a>
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
                    <form class="formValidate" id="formValidate" action="{{ route('r.device-attendance') }}"
                        method="POST">
                        @csrf
                        <div class="row">

                            <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">question_answer</i>
                                <label for="message">Message *</label>
                                <textarea id="message" name="message"
                                    class="materialize-textarea count-message-character @error('message') error @enderror">{{ session('UserSettings.attendance_message') }}</textarea>
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
                                            class="chip">Student Full Name
                                        </a>
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
                                </div>
                            </div>
                            <div class="input-field col s12" id="SDTTable1">
                                <table id="demo-foo-addrow2"
                                    class="table m-b-0 toggle-arrow-tiny centered responsive-table" data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">Code</th>
                                            <th>Name</th>
                                            <th>Parent Name</th>
                                            <th>Parent Primary Number</th>
                                            <th>Parent Secondary Number</th>
                                            <th data-sort-initial="true">Class - Section</th>
                                            <th>Stauts</th>
                                            <th>Actions</th>
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
                                        @foreach ($Records as $Record)
                                        <tr>
                                            <td>{{ $Record[0]->code }}</td>
                                            <td>{{ $Record[0]->student_first_name }} {{ $Record[0]->student_last_name }}</td>
                                            <td>{{ $Record[0]->parent_first_name }} {{ $Record[0]->parent_last_name }}</td>
                                            <td>{{ $Record[0]->parent_mobile_1 }}</td>
                                            <td>{{ $Record[0]->parent_mobile_2 }}</td>
                                            <td>{{ $Record[0]->class_name }} - {{ $Record[0]->section_name }}</td>
                                            @if ($Record[0]->active == "Y")
                                            <td><span class='label label-table label-success'>Active</span></td>
                                            @else
                                            <td><span class='label label-table label-danger'>Not Active</span></td>
                                            @endif
                                            <td class='chknone'>
                                                <p><label><input type='checkbox' name="{{ $Record[0]->code }}chk" class='chkbox filled-in'
                                                            value='{{ $Record[0]->code }}chk' /><span>Present</span></label></p>
                                            </td>

                                        </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="9">
                                                <div class="text-right">
                                                    <ul class="pagination pagination-split"> </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <div class="row">
                            <div class="input-field col s12">
                                <button class="btn waves-effect waves-light right submit" type="submit"
                                    name="action">Send SMS
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
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>

<script src="{{ asset('assets/extra-libs/prism/prism.js') }}"></script>
<script src="{{ asset('assets/libs/footable/dist/footable.all.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/footable/footable-init.js') }}"></script>

<script>
    $('#group').on('change', function() {
        var GroupId = $(this).val();
        var Data = "";
        $.ajax({
            type: "get",
            url: "{{ route('r.sectionlist', ['section' => ':id']) }}".replace(':id', GroupId),
            dataType: 'json',
            success: function(response) {
                Data += "<option value='0'>All</option>";
                for (let index = 0; index < response.length; index++) {
                    Data += '<option value="' + response[index].code + '">' + response[index].name +
                        '</option>';
                }
                $('#section').html(Data);
                var elem = document.querySelector('#section');
                var instance = M.FormSelect.init(elem);
            }
        });
    });

    $('#getmember').on('click', function() {

        var addrow = $('#demo-foo-addrow2');
        var footable = addrow.data('footable');

        var Data = "";

        var PrevValue = $('#getmember').html();

        $('#getmember').html(
            'Load Student Data...<div class="progress"><div class="indeterminate"></div></div>');

        var GroupId = $('#class').val();

        var SectionId = $('#section').val();

        $.ajax({
            type: "get",
            url: "{{ route('r.studentlist', ['groupid' => ':groupid', 'sectionid' => ':sectionid']) }}"
                .replace(':groupid', GroupId).replace(':sectionid', SectionId),
            dataType: 'json',
            success: function(response) {

                for (let index = 0; index < response.length; index++) {

                    if ("{{ @session('Data.company_nature') }}" == "S"|| "{{ @session('Data.company_nature') }}" == "HE") {
                        SectionName = " - " + response[index].section_name;
                    } else {
                        SectionName = "";
                    }

                    Data += "<tr>\n";
                    Data += "<td>" + response[index].code + "</td>\n";
                    Data += "<td>" + response[index].student_first_name + " " + response[index]
                        .student_last_name + "</td>\n";
                    Data += "<td>" + response[index].parent_first_name + " " + response[index]
                        .parent_last_name + "</td>\n";

                    Data += "<td>" + response[index].parent_mobile_1 + "</td>\n";
                    Data += "<td>" + response[index].parent_mobile_2 + "</td>\n";
                    Data += "<td>" + response[index].student_mobile_1 + "</td>\n";
                    Data += "<td>" + response[index].student_mobile_2 + "</td>\n";

                    if (response[index].active == "Y") {
                        Data +=
                            "<td><span class='label label-table label-success'>Active</span></td>\n";
                    } else {
                        Data +=
                            "<td><span class='label label-table label-danger'>Not Active</span></td>\n";
                    }
                    Data +=
                        "<td class='chknone'><p><label><input type='checkbox' name='" +
                        response[index].code +
                        "chk' class='chkbox filled-in' value='" + response[index].code +
                        "chk'/><span>SMS</span></label></p></td>\n";

                    Data += "</tr>";

                }

                $("#demo-foo-addrow2 > tbody > tr").remove();
                footable.appendRow(Data);
            }
        });
        $('#getmember').html(PrevValue);
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
