@extends('shared.layout')

@section('PageTitle', 'Student Attendance')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
<link href="{{ asset('assets/libs/footable/css/footable.core.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h3 class="font-medium m-b-0">Student Attendance</h3>
            <div class="custom-breadcrumb ml-auto">
                <a href="javascript:void(0)" class="breadcrumb">Attendance</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
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
                        <form class="formValidate" id="formValidate" action="{{ route('r.teacher-attendance') }}"
                            method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s12 m3 l4">
                                    <select class="form-select" name="subject" id="subject">
                                        <option value="">Select</option>
                                        @foreach ($TeacherSubjects as $TeacherSubject)
                                        <option value="{{ $TeacherSubject->subject_id }}">
                                            {{ $TeacherSubject->group_name }} - {{ $TeacherSubject->subject_name }}
                                        </option>
                                        @endforeach
                                    </select>
                                    <label for="subject" class="form-label">Subjects</label>
                                    @error('subject')
                                    <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>

                                {{-- Table 1 --}}
                                <div class="input-field m-t-10 col s12" id="SDTTable1">
                                    <div class="responsive-table">
                                        <table id="demo-foo-addrow2" class="table m-b-0 toggle-arrow-tiny centered"
                                            data-page-size="100">
                                            <thead>
                                                <tr>
                                                    <th>Code</th>
                                                    <th>Name</th>
                                                    <th>Actions</th>
                                                </tr>
                                            </thead>
                                            {{-- <div class="d-flex">
                                                    <div class="ml-auto">
                                                        <div class="form-group">
                                                            <input id="demo-input-search2" type="text" placeholder="Search"
                                                                autocomplete="off">

                                                            <p>
                                                                <label>
                                                                    <input type="checkbox" class="sl-all filled-in"
                                                                        checked />
                                                                    <span>Check All</span>
                                                                </label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </div> --}}
                                            <tbody>
                                                {{-- <tr colspan="9">
                                                <td>No Data Yet</td>
                                            </tr> --}}
                                            </tbody>
                                            <tfoot>
                                                <tr>
                                                    <td colspan="3">
                                                        <div class="text-right">
                                                            <ul class="pagination pagination-split"> </ul>
                                                        </div>
                                                    </td>
                                                </tr>
                                            </tfoot>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Save Attendance
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
</div>
@endsection

@section('Js')
<script src="{{ asset('assets/libs/jquery/dist/jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/materialize.min.js') }}"></script>
<script src="{{ asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js') }}"></script>
<script src="{{ asset('dist/js/app.js') }}"></script>
<script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
<script src="{{ asset('dist/js/custom.min.js') }}"></script>

<script src="{{ asset('assets/libs/footable/dist/footable.all.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/footable/footable-init.js') }}"></script>
<script>
    $('#subject').on('change', function() {

            var addrow = $('#demo-foo-addrow2');
            var footable = addrow.data('footable');

            var Data = "";
            var SubjectId = $('#subject').val() != "" ? $('#subject').val() : 0;

            $.ajax({
                type: "get",
                url: "{{ route('r.students-assigned-to-subject', ['id' => ':id']) }}".replace(':id',
                    SubjectId),
                dataType: 'json',
                success: function(response) {

                    for (let index = 0; index < response.length; index++) {
                        Data += "<tr>\n";
                        Data += "<td>" + response[index].code + "</td>\n";
                        Data += "<td>" + response[index].student_first_name + " " + response[index]
                            .student_last_name + "</td>\n";

                        Data +=
                            "<td class='chknone'><div class='row'><div class='col s12 m4 l4>'><p><label><input class='with-gap' name='" +
                            response[
                                index].code +
                            "chk' type='radio' value='L'  /><span>Leave</span></label></p></div>" +
                            "<div class='col s12 m4 l4>'><p><label><input class='with-gap' name='" +
                            response[index].code +
                            "chk' type='radio' value='P' checked /><span>Present</span></label></p></div>" +
                            "<div class='col s12 m4 l4>'><p><label><input class='with-gap' name='" +
                            response[index].code +
                            "chk' type='radio' value='A' /><span>Absent</span></label></p></div></div></td>\n";


                        Data += "</tr>";
                    }

                    $("#demo-foo-addrow2 > tbody > tr").remove();
                    footable.appendRow(Data);
                }
            });
        });
        $(".sl-all").on('click', function() {
            $('.chkbox').prop('checked', this.checked);
        });
</script>
@endsection
