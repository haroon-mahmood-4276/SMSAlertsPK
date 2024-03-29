@extends('shared.layout')

@section('PageTitle', 'Bulk SMS')

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
                <h3 class="font-medium">Bulk SMS</h3>
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">Messaging</a>
                    <a href="{{ route('r.bulk-sms-view') }}" class="breadcrumb">Bulk SMS</a>
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
                        <form class="formValidate" id="formValidate" action="{{ route('r.bulksms') }}" method="POST">
                            @csrf
                            <div class="row">
                                <div
                                    class="input-field col {{ session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE' ? 's4' : 's6' }}">
                                    <select class="form-select" name="group" id="group">
                                        <option value="0">All</option>
                                        @foreach ($Groups as $Group)
                                            <option value="{{ $Group->id }}">{{ $Group->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="group"
                                        class="form-label">{{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}</label>
                                    @error('group')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                    <div class="input-field col s4">
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
                                @endif

                                <div class="input-field col {{ session('Data.company_nature') == 'B' ? 's6' : 's4' }}">
                                    <select class="form-select" name="template" id="template">
                                        <option value="">Select</option>
                                        @foreach ($Templates as $Template)
                                            <option value="{{ $Template->id }}">{{ $Template->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="template" class="form-label">Template</label>
                                    @error('template')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="input-field col s12">
                                    <i class="material-icons prefix">question_answer</i>
                                    <label for="message">Message *</label>
                                    <textarea id="message" name="message"
                                        class="materialize-textarea count-message-character @error('message') error @enderror"
                                        value="{{ old('message') }}"></textarea>
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
                                            <a href="javascript:void(0)"
                                                id="{{ session('Data.company_nature') == 'B' ? 'member_full_name' : 'student_full_name' }}"
                                                onmouseup="textbox(this.id)"
                                                class="chip">{{ session('Data.company_nature') == 'B' ? 'Member' : 'Student' }}
                                                Full Name
                                            </a>
                                        </div>

                                        @if (session('Data.company_nature') == 'B')
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="brand_name" onmouseup="textbox(this.id)"
                                                    class="chip">Brand Name</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="brand_phone_1" onmouseup="textbox(this.id)"
                                                    class="chip">Brand Phone No 1</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="brand_phone_2" onmouseup="textbox(this.id)"
                                                    class="chip">Brand Phone No 2</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="brand_email" onmouseup="textbox(this.id)"
                                                    class="chip">Brand Email</a>
                                            </div>
                                        @else
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
                                                <a href="javascript:void(0)" id="school_phone_1"
                                                    onmouseup="textbox(this.id)" class="chip">School Phone No
                                                    1</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_phone_2"
                                                    onmouseup="textbox(this.id)" class="chip">School Phone No
                                                    2</a>
                                            </div>
                                            <div class="col s6 m3 l2 m-2">
                                                <a href="javascript:void(0)" id="school_email" onmouseup="textbox(this.id)"
                                                    class="chip">School Email</a>
                                            </div>
                                        @endif
                                    </div>
                                </div>
                                <div class="input-field col s12">
                                    <a href="javascript:void(0)" class="btn btn-small" id="getmember">
                                        Get
                                        {{ Session::get('Data.company_nature') == 'B' ? 'Members' : 'Students' }}
                                    </a>
                                </div>
                                <div class="col s12 m-t-25">
                                    <p><strong>SMS To</strong></p>
                                    <div class="row">
                                        <div class="col s12 m6 l3">
                                            <p>
                                                <label>
                                                    <input type="checkbox" id="parent_primary_number" class="filled-in"
                                                        name="parent_primary_number" checked />
                                                    <span>Parent Primary Number</span>
                                                </label>
                                            </p>
                                        </div>

                                        <div class="col s12 m6 l3">
                                            <p>
                                                <label>
                                                    <input type="checkbox" id="parent_secondary_number"
                                                        class="filled-in" name="parent_secondary_number" />
                                                    <span>Parent Secondary Number</span>
                                                </label>
                                            </p>
                                        </div>
                                        @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                            <div class="col s12 m6 l3">
                                                <p>
                                                    <label>
                                                        <input type="checkbox" id="student_primary_number"
                                                            class="filled-in" name="student_primary_number" />
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

                                {{-- Table 1 --}}
                                <div class="input-field m-t-10 col s12" id="SDTTable1">
                                    <table id="demo-foo-addrow2"
                                        class="table m-b-0 toggle-arrow-tiny centered responsive-table" data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th data-toggle="true">Code</th>
                                                <th>Name</th>
                                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                    <th>Parent Name</th>
                                                @endif
                                                <th>{{ session('Data.company_nature') == 'B' ? '' : 'Parent' }}
                                                    Primary Number</th>
                                                <th>{{ session('Data.company_nature') == 'B' ? '' : 'Parent' }}
                                                    Secondary Number</th>
                                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                    <th>Student Primary Number</th>
                                                    <th>Student Secondary Number</th>
                                                @endif
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

                                                        <a href="javascript:void(0)" id="add_all_data"
                                                            class="waves-effect waves-light btn"><i
                                                                class="material-icons left">add</i>Add All</a>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <tbody>
                                            {{-- <tr colspan="9">
                                                <td>No Data Yet</td>
                                            </tr> --}}
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

                                {{-- Table 2 --}}
                                <div class="input-field col s12 rounded"
                                    style="border: 2px solid rgb(230, 230, 230) !important; margin-top: 50px !important; padding: 30px 15px !important;">
                                    <table id="demo-foo-addrow"
                                        class="table my_final_table m-b-0 toggle-arrow-tiny centered responsive-table"
                                        data-page-size="10">
                                        <thead>
                                            <tr>
                                                <th data-toggle="true">Code</th>
                                                <th>Name</th>
                                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                    <th>Parent Name</th>
                                                @endif
                                                <th>{{ session('Data.company_nature') == 'B' ? '' : 'Parent' }}
                                                    Primary Number</th>
                                                <th>{{ session('Data.company_nature') == 'B' ? '' : 'Parent' }}
                                                    Secondary Number</th>
                                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                    <th>Student Primary Number</th>
                                                    <th>Student Secondary Number</th>
                                                @endif
                                                <th>Stauts</th>
                                                <th>Actions</th>
                                            </tr>
                                        </thead>
                                        <div class="">
                                            <div class="d-flex">
                                                <div class="ml-auto">
                                                    <div class="form-group">
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
                                            {{-- <tr colspan="9">
                                                <td>No Data Yet</td>
                                            </tr> --}}
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
                        Data += '<option value="' + response[index].id + '">' + response[index].name +
                            '</option>';
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
                url: "{{ route('templates.show', ['template' => ':id']) }}".replace(':id',
                    TemplateId),
                dataType: 'json',
                success: function(response) {
                    $('#message').val(response.template);
                }
            });
        });

        $('#getmember').on('click', function() {

            var addrow = $('#demo-foo-addrow2');
            var footable = addrow.data('footable');

            var Data = "";

            var PrevValue = $('#getmember').html();

            $(this).attr("disabled", true);
            $(this).html(
                'Load Student Data...<div class="progress"><div class="indeterminate"></div></div>')


            var GroupId = $('#group').val();

            var SectionId = $('#section').val();

            var SectionId = $('#section').val();

            $.ajax({
                type: "get",
                url: "{{ route('r.studentlist', ['groupid' => ':groupid', 'sectionid' => ':sectionid']) }}"
                    .replace(':groupid', GroupId).replace(':sectionid', SectionId),
                dataType: 'json',
                success: function(response) {

                    for (let index = 0; index < response.length; index++) {

                        if ("{{ @session('Data.company_nature') }}" == "S" ||
                            "{{ @session('Data.company_nature') }}" == "HE") {
                            SectionName = " - " + response[index].section_name;
                        } else {
                            SectionName = "";
                        }

                        Data += "<tr>\n";
                        Data += "<td>" + response[index].code + "</td>\n";
                        Data += "<td>" + response[index].student_first_name + " " + response[index]
                            .student_last_name + "</td>\n";
                        if ("{{ @session('Data.company_nature') }}" == "S" ||
                            "{{ @session('Data.company_nature') }}" == "HE") {
                            Data += "<td>" + response[index].parent_first_name + " " + response[index]
                                .parent_last_name + "</td>\n";
                        }

                        Data += "<td>" + response[index].parent_mobile_1 + "</td>\n";
                        Data += "<td>" + response[index].parent_mobile_2 + "</td>\n";
                        if ("{{ @session('Data.company_nature') }}" == "S" ||
                            "{{ @session('Data.company_nature') }}" == "HE") {
                            Data += "<td>" + response[index].student_mobile_1 + "</td>\n";
                            Data += "<td>" + response[index].student_mobile_2 + "</td>\n";
                        }

                        if (response[index].active == "Y") {
                            Data +=
                                "<td><span class='label label-table label-success'>Active</span></td>\n";
                        } else {
                            Data +=
                                "<td><span class='label label-table label-danger'>Not Active</span></td>\n";
                        }
                        Data +=
                            "<td><button class='btn add-student' type='button'><i class='material-icons'>add_to_queue</i></button></td>\n";

                        Data +=
                            "<td class='chknone' style='display: none !important;'><p><label><input type='checkbox' disabled name='" +
                            response[index].code +
                            "chk' class='chkbox filled-in' value='" + response[index].code +
                            "chk'/><span>SMS</span></label></p></td>\n";

                        Data += "</tr>";

                    }

                    $("#demo-foo-addrow2 > tbody > tr").remove();
                    footable.appendRow(Data);
                    $('#getmember').html(PrevValue);
                    $('#getmember').attr("disabled", false);
                }
            });
        });

        $('.reset').on('click', function() {
            $("#demo-foo-addrow2 > tbody > tr").remove();
        });

        $(".sl-all").on('click', function() {
            $('.chkbox').prop('checked', this.checked);
        });

        $('.my_final_table tbody').empty();

        $('tbody').on('click', '.add-student', function() {
            myParent = $(this).closest('table').attr('id');
            if (myParent == "demo-foo-addrow2") {
                myTableRow = $(this).closest('table tr').html().replace('add_to_queue', 'remove_from_queue');
                $('.my_final_table').data('footable').appendRow('<tr>' + myTableRow + '</tr>');
                $('.my_final_table tbody td.chknone').show();
                $('.my_final_table tbody td.chknone input[type=checkbox]').prop("disabled", false).prop("checked",
                    true);

            } else {
                myTableRow = $(this).closest('table tr').html().replace('remove_from_queue', 'add_to_queue');
                $('#demo-foo-addrow2').data('footable').appendRow('<tr>' + myTableRow + '</tr>');
                $('#demo-foo-addrow2 tbody td.chknone').hide();
                $('#demo-foo-addrow2 tbody td.chknone input[type=checkbox]').prop("disabled", true);
            }
            $(this).closest('table tr').remove();
        });

        $('#add_all_data').on('click', function() {
            var Data = "";
            $("#demo-foo-addrow2 > tbody > tr").each(function() {
                Data += ('<tr>' + $(this).html().replace('add_to_queue', 'remove_from_queue').replace(
                        "display: none", "display: block").replace("disabled", "") +
                    '</tr>')
                // $('.my_final_table tbody td.chknone').show();
                // $('.my_final_table tbody td.chknone input[type=checkbox]').prop("disabled",
                //     false).prop(
                //     "checked", true);
            });
            console.log(Data);
            $('#demo-foo-addrow2 > tbody').empty();
            $('.my_final_table').data('footable').appendRow(Data);

            // $('.my_final_table').footable();
            // $('.my_final_table').on('change', function(e) {
            //     e.preventDefault();
            //     var pageSize = $(this).val();
            //     $('.my_final_table').data('page-size', pageSize);
            //     $('.my_final_table').trigger('footable_initialized');
            // });
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
