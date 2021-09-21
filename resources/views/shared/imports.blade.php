@extends('shared.layout')

@section('PageTitle', 'Data Import')

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
            <h3 class="font-medium">Imports </h3>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                <a href="javascript:void(0)" class="breadcrumb">Imports</a>
            </div>
        </div>
        <p>Download the sample file first, feed tha data, and upload that file.</p>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col l12 m12 s12">

                @if (Session::has('AlertType') && Session::has('AlertMsg'))
                <div class="row">
                    <div class="col l12 m12 s12 m-5">
                        <div class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                            {{ Session::get('AlertMsg') }}
                        </div>
                    </div>
                </div>
                @endif

                @if (session()->has('failures'))
                <div class="row">
                    <div class="col l12 m12 s12 m-5">
                        <div class="danger-alert-bar p-15 m-b-20 white-text">
                            <ul>
                                @foreach (session()->get('failures') as $validation)
                                <li>
                                    File row: {{ $validation->row() }} - Value:
                                    {{ $validation->values()[$validation->attribute()] }} -
                                    @foreach ($validation->errors() as $error)
                                    Error: {{ $error }}
                                    @endforeach
                                </li>
                                @endforeach
                            </ul>
                            <p>All the other data is imported successfully.</p>
                        </div>
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 l12">
                                <form class="m-t-10"
                                    action="{{ session('Data.company_nature') == 'B' ? route('r.importgroups') : route('r.importclasses') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col s12">
                                            <h4>Import
                                                {{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}
                                            </h4>
                                            <div>
                                                <ul class="collapsible">
                                                    <li>
                                                        <div class="collapsible-header">
                                                            <i class="material-icons">perm_device_information</i>
                                                            <h5> Readme first before import.</h5>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <h3>Validaiton Rules</h3>
                                                            <ul>
                                                                <li><b>'code'</b> : It is required, should be numeric,
                                                                    should be 5 digits only.</li>
                                                                <li><b>'name'</b> : It is required,
                                                                    allowed upto 50 characters only.</li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="file-field input-field col s10 m11 l11 ">
                                                <div class="btn">
                                                    <span>Upload File</span>
                                                    <input type="file" name="groupsfile">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Please upload only .csv or .xls document">
                                                </div>
                                            </div>
                                            <div class="input-field col s2 m1 l1">
                                                <button class="btn pulse blue waves-effect waves-light" type="submit"><i
                                                        class="material-icons">file_upload</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p>Don't have sample file? Download <a
                                        href="{{ session('Data.company_nature') == 'B' ? route('r.csvgroups') : route('r.csvclasses') }}">.csv
                                        file</a> or <a
                                        href="{{ session('Data.company_nature') == 'B' ? route('r.xlsgroups') : route('r.xlsclasses') }}">.xls
                                        file</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 l12">
                                <form class="m-t-10" action="{{ route('r.importsections') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col s12">
                                            <h4>Import Sections</h4>
                                            <div>
                                                <ul class="collapsible">
                                                    <li>
                                                        <div class="collapsible-header">
                                                            <i class="material-icons">perm_device_information</i>
                                                            <h5> Readme first before import.</h5>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <h3>Validaiton Rules</h3>
                                                            <ul>
                                                                <li><b>'class_id'</b> : It is required, should be
                                                                    numeric, should be 5 digits only, should match
                                                                    with class code.</li>
                                                                <li><b>'code'</b> : It is required, should be
                                                                    numeric, should be 5 digits only, should be
                                                                    unique with respect to class.</li>
                                                                <li><b>'name'</b> : It is required,
                                                                    allowed upto 50 characters only.</li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="file-field input-field col s10 m11 l11">
                                                <div class="btn">
                                                    <span>Upload File</span>
                                                    <input type="file" name="sectionsfile">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Please upload only .csv or .xls document">
                                                </div>
                                            </div>
                                            <div class="input-field col s2 m1 l1">
                                                <button class="btn pulse blue waves-effect waves-light" type="submit"><i
                                                        class="material-icons">file_upload</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p>Don't have sample file? Download <a href="{{ route('r.csvsections') }}">.csv
                                        file</a> or <a href="{{ route('r.xlssections') }}">.xls file</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 l12">
                                <form class="m-t-10"
                                    action="{{ session('Data.company_nature') == 'B' ? route('r.importmembers') : route('r.importstudents') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col s12">
                                            <h4>Import
                                                {{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}
                                            </h4>
                                            <div>
                                                <ul class="collapsible">
                                                    <li>
                                                        <div class="collapsible-header">
                                                            <i class="material-icons">perm_device_information</i>
                                                            <h5> Readme first before import.</h5>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <h3>Validaiton Rules</h3>
                                                            <ul>
                                                                @if (session('Data.company_nature') == 'B')
                                                                <li><b>'group_id'</b> : It is required, should be
                                                                    numeric, should be 5 digits only, should match
                                                                    with group code.</li>

                                                                <li><b>'code'</b> : It is required, should be
                                                                    alpha numeric, upto 20 digits, should be
                                                                    unique.</li>

                                                                <li><b>'member_first_name'</b> : It is required,
                                                                    allowed upto 50 characters only.</li>

                                                                <li><b>'member_last_name'</b> : It is nullabe,
                                                                    allowed upto 50 characters only.</li>

                                                                <li><b>'member_mobile_1'</b> : It is required,
                                                                    should be 12 digits only, should be unique, must
                                                                    start with 923.</li>

                                                                <li><b>'member_mobile_2'</b> : It is nullable,
                                                                    should be 12 digits only, must start with 923.</li>

                                                                <li>
                                                                    <b>'gender'</b> : It is requred, must b 'M', 'F'
                                                                </li>

                                                                <li>
                                                                    <b>'active'</b> : It is required, must b 'Y', 'N'
                                                                </li>
                                                                @else
                                                                <li><b>'class_id'</b> : It is required, should be
                                                                    numeric, should be 5 digits only, should match
                                                                    with class code.</li>

                                                                <li><b>'section_id'</b> : It is required, should be
                                                                    numeric, should be 5 digits only, should match
                                                                    with section code with respect to class.</li>

                                                                <li><b>'code'</b> : It is required, should be
                                                                    alpha numeric, upto 20 digits, should be
                                                                    unique.</li>

                                                                <li><b>'student_first_name'</b> : It is required,
                                                                    allowed upto 50 characters only.</li>

                                                                <li><b>'student_last_name'</b> : It is nullabe,
                                                                    allowed upto 50 characters only.</li>

                                                                <li>
                                                                    <b>'gender'</b> : It is requred, must b 'M', 'F'
                                                                </li>

                                                                <li><b>'student_mobile_1'</b> : It is required,
                                                                    should be 12 digits only, should be unique, must
                                                                    start with 923.</li>

                                                                <li><b>'student_mobile_1'</b> : It is nullable,
                                                                    should be 12 digits only, must start with 923.</li>

                                                                <li><b>'dob'</b> : It is nullable, formate should be
                                                                    (yyyy-mm-dd)</li>

                                                                <li><b>'parent_first_name'</b> : It is required,
                                                                    allowed upto 50 characters only.</li>

                                                                <li><b>'parent_last_name'</b> : It is required,
                                                                    allowed upto 50 characters only.</li>

                                                                <li><b>'parent_mobile_1'</b> : It is required,
                                                                    should be 12 digits only, must
                                                                    start with 923.</li>

                                                                <li><b>'parent_mobile_2'</b> : It is required,
                                                                    should be 12 digits only, must
                                                                    start with 923.</li>

                                                                <li><b>'student_mobile_1'</b> : It is nullable,
                                                                    should be 12 digits only, must start with 923.</li>

                                                                <li>
                                                                    <b>'active'</b> : It is required, must b 'Y', 'N'
                                                                </li>
                                                                @endif
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="file-field input-field col s10 m11 l11">
                                                <div class="btn">
                                                    <span>Upload File</span>
                                                    <input type="file" name="membersfile">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Please upload only .csv or .xls document">
                                                </div>
                                            </div>
                                            <div class="input-field col s2 m1 l1">
                                                <button class="btn pulse blue waves-effect waves-light" type="submit"><i
                                                        class="material-icons">file_upload</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p>Don't have sample file? Download <a
                                        href="{{ session('Data.company_nature') == 'B' ? route('r.csvmembers') : route('r.csvstudents') }}">.csv
                                        file</a> or <a
                                        href="{{ session('Data.company_nature') == 'B' ? route('r.xlsmembers') : route('r.xlsstudents') }}">.xls
                                        file</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('Data.company_nature') == 'HE')
                <div class="card">
                    <div class="card-content">
                        <div class="row">
                            <div class="col s12 l12">
                                <form class="m-t-10" action="{{ route('r.importsubjects') }}"
                                    enctype="multipart/form-data" method="POST">
                                    @csrf
                                    <div class="row">
                                        <div class="col s12">
                                            <h4>Import Subjects</h4>
                                            <div>
                                                <ul class="collapsible">
                                                    <li>
                                                        <div class="collapsible-header">
                                                            <i class="material-icons">perm_device_information</i>
                                                            <h5> Readme first before import.</h5>
                                                        </div>
                                                        <div class="collapsible-body">
                                                            <h3>Validaiton Rules</h3>
                                                            <ul>
                                                                <li><b>'class_id'</b> : It is required, should be
                                                                    numeric, should contain only 5 digits, should match
                                                                    with class code.</li>
                                                                <li><b>'code'</b> : It is required, should be
                                                                    numeric, should contain only 5 digits, should be
                                                                    unique with respect to class.</li>
                                                                <li><b>'name'</b> : It is required,
                                                                    allowed upto 50 characters only.</li>
                                                            </ul>
                                                        </div>
                                                    </li>
                                                </ul>
                                            </div>
                                            <div class="file-field input-field col s10 m11 l11">
                                                <div class="btn">
                                                    <span>Upload File</span>
                                                    <input type="file" name="subjectsfile">
                                                </div>
                                                <div class="file-path-wrapper">
                                                    <input class="file-path validate" type="text"
                                                        placeholder="Please upload only .csv or .xls document">
                                                </div>
                                            </div>
                                            <div class="input-field col s2 m1 l1">
                                                <button class="btn pulse blue waves-effect waves-light" type="submit"><i
                                                        class="material-icons">file_upload</i></button>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                                <p>Don't have sample file? Download <a href="{{ route('r.csvsubjects') }}">.csv
                                        file</a> or <a href="{{ route('r.xlssubjects') }}">.xls file</a>.
                                </p>
                            </div>
                        </div>
                    </div>
                </div>
                @endif

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
@endsection
