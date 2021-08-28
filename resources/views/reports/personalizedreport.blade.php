@extends('shared.layout')

@section('PageTitle', 'Customized Report')

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
                <h3 class="font-medium m-b-0">Personalized Report</h3>
                {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">Reports</a>
                    <a href="{{ route('r.personalizedreport') }}" class="breadcrumb">Personalized Report</a>
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
                        <form class="formValidate" id="formValidate" action="{{ route('r.personalizedreport') }}"
                            target="_blank">
                            <div class="row">
                                <div class="m-t-20 col s12 m12 l12">
                                    <h3 class="card-title">Date-wise Report</h3>
                                </div>

                                <div class="col s6 m6 l6">
                                    <label class="m-t-20">Start Date</label>
                                    <div class="input-fleid">
                                        <input type="text" value="{{ old('start_date') }}" id="start_date"
                                            name="start_date" placeholder="1999-01-01">
                                    </div>
                                    @error('start_date')
                                        <span style="color: rgb(255, 0, 0)">{{ $message }}</span>
                                    @enderror
                                </div>

                                <div class="col s6 m6 l6">
                                    <label class="m-t-20">End Date</label>
                                    <div class="input-fleid">
                                        <input type="text" value="{{ old('end_date') }}" id="end_date" name="end_date"
                                            placeholder="1999-01-01">
                                    </div>
                                    @error('end_date')
                                        <span style="color: rgb(255, 0, 0)">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="m-t-10 col s12 m12 l12">
                                    <hr>
                                    <h3 class="card-title">
                                        {{ session('Data.company_nature') == 'B' ? 'Group' : 'Class' }}-wise Report</h3>
                                </div>

                                <div class="input-field col s6">
                                    <select class="form-select" name="group" id="group">
                                        <option value="0">All</option>
                                        @foreach ($Groups as $Group)
                                            <option value="{{ $Group->id }}">{{ $Group->name }}</option>
                                        @endforeach
                                    </select>
                                    <label for="group" class="form-label">{{ session('Data.company_nature') == 'B' ? 'Group' : 'Class' }}</label>
                                    @error('group')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE' )
                                    <div class="input-field col s6">
                                        <select class="form-select" name="section" id="section">
                                            <option value="0">All</option>
                                        </select>
                                        <label for="section" class="form-label">Section</label>
                                        @error('section')
                                            <span style="color: red">{{ $message }}</span>
                                        @enderror
                                    </div>
                                @endif

                                <div class="input-field col s12 m6 l6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="phone_number" name="phone_number" type="text"
                                        class="@error('phone_number') error @enderror" value="{{ old('phone_number') }}"
                                        placeholder="923001234567">
                                    <label for="phone_number">Phone Number *</label>
                                    @error('phone_number')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Show Report
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
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script
        src="{{ asset('assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js') }}">
    </script>
    <script>
        $(document).ready(function() {
            // $('#SDTTable').hide();
        });

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

            $('#getmember').html(
                'Load Student Data...<div class="progress"><div class="indeterminate"></div></div>');

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

                        if ("{{ @session('Data.company_nature') }}" == "S") {
                            SectionName = " - " + response[index].section_name;
                        } else {
                            SectionName = "";
                        }

                        Data += "<tr>\n";
                        Data += "<td>" + response[index].code + "</td>\n";
                        Data += "<td>" + response[index].student_first_name + " " + response[index]
                            .student_last_name + "</td>\n";
                        if ("{{ @session('Data.company_nature') }}" == "S") {
                            Data += "<td>" + response[index].parent_first_name + " " + response[index]
                                .parent_last_name + "</td>\n";
                        }

                        Data += "<td>" + response[index].parent_mobile_1 + "</td>\n";
                        Data += "<td>" + response[index].parent_mobile_2 + "</td>\n";
                        if ("{{ @session('Data.company_nature') }}" == "S") {
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
                        Data += "<td><p><label><input type='checkbox' name='" + response[index].id +
                            "chk' class='chkbox' /><span>SMS</span></label></p></td>\n";
                        Data += "</tr>";

                        // }
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

        $('#end_date').bootstrapMaterialDatePicker({
            weekStart: 1,
            time: false
        });
        $('#start_date').bootstrapMaterialDatePicker({
            weekStart: 1,
            time: false
        }).on('change', function(e, date) {
            $('#end_date').bootstrapMaterialDatePicker('setMinDate', date);
        });
    </script>
@endsection
