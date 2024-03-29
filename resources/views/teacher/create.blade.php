@extends('shared.layout')

@section('PageTitle', 'Create Teacher')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
<link rel="stylesheet" type="text/css"
    href="{{ asset('assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="container-fluid row">
        <div class="col l12 m12 s12">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title">Create Teacher
                    </h5>
                    <form action="{{ route('teachers.store') }}" method="POST">
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

                            <div class="col s12 m12 l12">
                                <div class="row">
                                    <div class="input-field col s12 m6 l6">
                                        <i class="material-icons prefix">text_format</i>
                                        <input id="code" name="code" type="text" class="@error('code') error @enderror"
                                            value="{{ old('code') }}">
                                        <label for="code">Code *</label>
                                        @error('code')
                                        <span style="color: red">{{ $message }}</span>
                                        @else
                                        <span style="color: red">&nbsp;</span>
                                        @enderror
                                    </div>
                                </div>
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">text_format</i>
                                <input id="first_name" name="first_name" type="text"
                                    class="@error('first_name') error @enderror" value="{{ old('first_name') }}">
                                <label for="first_name">First Name *</label>
                                @error('first_name')
                                <span style="color: red">{{ $message }}</span>
                                @else
                                <span style="color: red">&nbsp;</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">text_format</i>
                                <input id="last_name" name="last_name" type="text"
                                    class="@error('last_name') error @enderror" value="{{ old('last_name') }}">
                                <label for="last_name">Last Name *</label>
                                @error('last_name')
                                <span style="color: red">{{ $message }}</span>
                                @else
                                <span style="color: red">&nbsp;</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">text_format</i>
                                <input id="email" name="email" type="email" class="@error('email') error @enderror"
                                    value="{{ old('email') }}">
                                <label for="email">Email*</label>
                                @error('email')
                                <span style="color: red">{{ $message }}</span>
                                @else
                                <span style="color: red">&nbsp;</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">text_format</i>
                                <input id="password" name="password" type="password"
                                    class="@error('password') error @enderror" value="{{ old('password') }}">
                                <label for="password">Password *</label>
                                @error('password')
                                <span style="color: red">{{ $message }}</span>
                                @else
                                <span style="color: red">&nbsp;</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">text_format</i>
                                <input id="mobile_1" name="mobile_1" type="text"
                                    class="@error('mobile_1') error @enderror" value="{{ old('mobile_1') }}"
                                    placeholder="923001234567">
                                <label for="mobile_1">Primary Mobile Number *</label>
                                @error('mobile_1')
                                <span style="color: red">{{ $message }}</span>
                                @else
                                <span style="color: red">&nbsp;</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">text_format</i>
                                <input id="mobile_2" name="mobile_2" type="text"
                                    class="@error('mobile_2') error @enderror" value="{{ old('mobile_2') }}"
                                    placeholder="923001234567">
                                <label for="mobile_2">Secondary Mobile Number</label>
                                @error('mobile_2')
                                <span style="color: red">{{ $message }}</span>
                                @else
                                <span style="color: red">&nbsp;</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <i class="material-icons prefix">text_format</i>
                                <input id="coodinator_number" name="coodinator_number" type="text"
                                    class="@error('coodinator_number') error @enderror"
                                    value="{{ old('coodinator_number') }}" placeholder="923001234567">
                                <label for="coodinator_number">Coodinator Number *</label>
                                @error('coodinator_number')
                                <span style="color: red">{{ $message }}</span>
                                @else
                                <span style="color: red">&nbsp;</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l6">
                                <select class="form-select" name="active" id="active">
                                    <option value="">Select</option>
                                    <option value="Y" {{ old('active') == 'Y' ? ' selected' : '' }}>Active</option>
                                    <option value="N" {{ old('active') == 'N' ? 'selected' : '' }}>Not Active
                                    </option>
                                </select>
                                <label for="active" class="form-label">Status</label>
                                @error('active')
                                <span style="color: red">{{ $message }}</span>
                                @else
                                <span style="color: red">&nbsp;</span>
                                @enderror
                            </div>

                            <div class="m-t-20 col s12 m12 l12">
                                <hr>
                                <h3 class="card-title">Assign Subjects to teacher</h3>
                            </div>

                            <div class="input-field col s12 m6 l4">
                                <select class="form-select" name="subject" id="subject">
                                    <option value="">Select</option>
                                    @foreach ($Subjects as $Subject)
                                    <option value="{{ $Subject->id }}">{{ $Subject->group_name }} - {{ $Subject->name }}
                                    </option>
                                    @endforeach
                                </select>
                                <label for="subject" class="form-label">Subjects</label>
                                @error('subject')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            <div class="input-field col s12 m6 l4">
                                <select class="form-select" name="section" id="section">
                                    <option value="">Select</option>
                                </select>
                                <label for="section" class="form-label">Section</label>
                                @error('section')
                                <span style="color: red">{{ $message }}</span>
                                @enderror
                            </div>

                            {{-- Table 1 --}}
                            <div class="input-field m-t-10 col s12" id="SDTTable1">
                                <table id="demo-foo-addrow2"
                                    class="table m-b-0 toggle-arrow-tiny centered responsive-table" data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">Code</th>
                                            <th>Name</th>
                                            <th>Class - Section</th>
                                            <th>For subject</th>
                                            <th>Stauts</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <div class="___class_+?49___">
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
                                            <td colspan="5">
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
                                            <th>Class - Section</th>
                                            <th>For subject</th>
                                            <th>Stauts</th>
                                            <th>Actions</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        {{-- <tr colspan="9">
                                                <td>No Data Yet</td>
                                            </tr> --}}
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5">
                                                <div class="text-right">
                                                    <ul class="pagination pagination-split"> </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="input-field m-t-20 col s12">
                                <button class="btn waves-effect waves-light right submit" type="submit"
                                    name="action">Save
                                </button>
                                <a href="{{ route('teachers.index') }}"
                                    class="btn waves-effect red waves-light right m-r-10">Back to Teachers List</a>
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

{{-- <script src="{{asset('assets/extra-libs/prism/prism.js')}}"></script> --}}
<script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
<script
    src="{{ asset('assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js') }}">
</script>

<script src="{{ asset('assets/extra-libs/prism/prism.js') }}"></script>
<script src="{{ asset('assets/libs/footable/dist/footable.all.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/footable/footable-init.js') }}"></script>

<script>
    $('#subject').on('change', function() {
            var SubjectId = $(this).val() != "" ? $(this).val() : 0;
            var Data = "";
            $.ajax({
                type: "get",
                url: "{{ route('r.sections-against-subject', ['id' => ':id']) }}".replace(':id',
                    SubjectId),
                dataType: 'json',
                success: function(response) {
                    Data += "<option value=''>Select</option>";
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

        $('#section').on('change', function() {

            var addrow = $('#demo-foo-addrow2');
            var footable = addrow.data('footable');

            var Data = "";
            var SubjectId = $('#subject').val() != "" ? $('#subject').val() : 0;
            var SectionId = $(this).val() != "" ? $(this).val() : 0;

            var SubjectName = $('#subject').find(":selected").text();

            $.ajax({
                type: "get",
                url: "{{ route('r.students-against-subject', ['subject_id' => ':subject_id', 'id' => ':id']) }}"
                    .replace(':subject_id', SubjectId).replace(':id', SectionId),
                dataType: 'json',
                success: function(response) {

                    for (let index = 0; index < response.length; index++) {
                        Data += "<tr>\n";
                        Data += "<td>" + response[index].code + "</td>\n";
                        Data += "<td>" + response[index].student_first_name + " " + response[index]
                            .student_last_name + "</td>\n";
                        Data += "<td>" + response[index].group_name + " - " + response[index]
                            .section_name + "</td>\n";

                        Data += "<td>" + SubjectName + "</td>\n";

                        Data +=
                            "<td><span class='label label-table label-success'>Active</span></td>\n";

                        Data +=
                            "<td class='student_id'><button class='btn add-student' type='button'><i class='material-icons'>add_to_queue</i></button>" +
                            "<input type='hidden' name='stdid" +
                            SubjectId + "_" + response[index].id + "' value='stdid" +
                            SubjectId + "_" + response[index].id + "' disabled/></td>\n";

                        Data += "</tr>";
                    }

                    $("#demo-foo-addrow2 > tbody > tr").remove();
                    footable.appendRow(Data);
                }
            });
        });

        $('tbody').on('click', '.add-student', function() {
            myParent = $(this).closest('table').attr('id');
            if (myParent == "demo-foo-addrow2") {
                flag = 0;
                myTableRow = $(this).closest('table tr').html().replace('add_to_queue', 'remove_from_queue');

                $(".my_final_table > tbody > tr > td.student_id input[type=hidden]").each(function() {
                    if ($(this).val() == $(myTableRow).closest('td.student_id').find('input[type=hidden]')
                        .val()) {
                        flag = 1;
                    }
                });

                if (flag == 0) {
                    $('.my_final_table').data('footable').appendRow('<tr>' + myTableRow + '</tr>');
                    $('.my_final_table tbody td.student_id input[type=hidden]').prop("disabled", false);
                }
            }
            $(this).closest('table tr').remove();
            // TableRowsCount();
        });

        $('#add_all_data').on('click', function() {
            $("#demo-foo-addrow2 > tbody > tr").each(function() {
                flag = 0;
                myTableRow = $(this).closest('table tr').html().replace('add_to_queue',
                    'remove_from_queue');

                $(".my_final_table > tbody > tr > td.student_id input[type=hidden]").each(function() {
                    if ($(this).val() == $(myTableRow).closest('td.student_id').find(
                            'input[type=hidden]')
                        .val()) {
                        flag = 1;
                    }
                });

                if (flag == 0) {
                    $('.my_final_table').data('footable').appendRow('<tr>' + myTableRow + '</tr>');
                    $('.my_final_table tbody td.student_id input[type=hidden]').prop("disabled", false);
                }
                $(this).remove();
                // TableRowsCount();
            });
        });

        function TableRowsCount() {
            var tableRows = $('.my_final_table>tbody>tr').length;
            if (tableRows > 0) {
                $('.submit').prop("disabled", false);
            } else {
                $('.submit').prop("disabled", true);
            }
        }
</script>
@endsection
