@extends('shared.layout')

@section('PageTitle', @(session('Data.company_nature') == 'B') ? 'Members' : 'Students' . ' List')

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
                <h3 class="font-medium m-b-0">{{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}</h3>
                {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)"
                        class="breadcrumb">{{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="row">
                <div class="col l12 m12 s12">
                    <div class="card">
                        <div class="card-content">
                            <div class="row">
                                <div class="col s12 l12">
                                    @if (Session::has('AlertType') && Session::has('AlertMsg'))
                                        <div class="row">
                                            <div class="col l12 m12 s12 m-5">
                                                <div
                                                    class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                                                    {{ Session::get('AlertMsg') }}
                                                </div>
                                            </div>
                                        </div>
                                    @endif
                                    Show &nbsp;
                                    <div class="input-field inline">
                                        <select id="demo-show-entries">
                                            <option value="10">10</option>
                                            <option value="15">15</option>
                                            <option value="20">20</option>
                                            <option value="30">30</option>
                                            <option value="40">40</option>
                                            <option value="50">50</option>
                                        </select>
                                    </div>
                                    &nbsp; entries
                                </div>
                            </div>
                            <table id="demo-foo-addrow2" class="table m-b-0 toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">Roll No</th>
                                        <th data-hide="phone">Name</th>
                                        <th data-hide="all">Student Primary Number</th>
                                        <th data-hide="phone">Parent Name</th>
                                        <th data-hide="phone">Parent Primary Number</th>
                                        <th data-sort-initial="true" data-toggle="true"  data-hide="phone">
                                            {{ session('Data.company_nature') == 'B' ? 'Group' : 'Class' }}
                                            @if (session('Data.company_nature') == 'S')
                                                - Section
                                            @endif
                                        </th>
                                        <th data-hide="phone">Stauts</th>
                                        <th data-hide="all">Student Secondary Number</th>
                                        <th data-hide="all">Parent Secondary Number</th>
                                        <th data-hide="all">Date of Birth</th>
                                        <th data-hide="all">CNIC</th>
                                        <th data-hide="all">Gender</th>
                                        <th data-hide="phone">Actions</th>
                                    </tr>
                                </thead>
                                <div class="m-t-5">
                                    <div class="d-flex">
                                        <div class="mr-auto">
                                            <div class="form-group">
                                                <a href="{{ route('data.create') }}" class="btn btn-small"><i
                                                        class="icon wb-plus waves-effect waves-light"
                                                        aria-hidden="true"></i>Add New
                                                    {{ Session::get('Data.company_nature') == 'B' ? 'Member' : 'Student' }}
                                                </a>
                                            </div>
                                        </div>
                                        <div class="ml-auto">
                                            <div class="form-group">
                                                <input id="demo-input-search2" type="text" placeholder="Search"
                                                    autocomplete="off">
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <tbody>
                                    @foreach ($MobileDatas as $MobileData)
                                        <tr>

                                            <td>{{ $MobileData->code }}</td>
                                            <td>{{ $MobileData->student_first_name }}
                                                {{ $MobileData->student_last_name }}
                                            </td>
                                            <td>{{ $MobileData->student_mobile_1 }}</td>
                                            <td>{{ $MobileData->parent_first_name }}
                                                {{ $MobileData->parent_last_name }}
                                            </td>
                                            <td>{{ $MobileData->parent_mobile_1 }}</td>
                                            <td>{{ $MobileData->group_name }} @if (session('Data.company_nature') == 'S')
                                                    - {{ $MobileData->section_name }}
                                                @endif
                                            </td>
                                            <td>
                                                @if ($MobileData->active == 'Y')
                                                <span class="label label-table label-success">Active</span>
                                                @else
                                                <span class="label label-table label-danger">Not Active</span>
                                                @endif
                                            </td>
                                            <td>{{ $MobileData->student_mobile_2 }}</td>
                                            <td>{{ $MobileData->parent_mobile_2 }}</td>
                                            <td>{{ $MobileData->dob }}</td>
                                            <td>{{ $MobileData->cnic }}</td>
                                            <td>{{ $MobileData->gender }}</td>
                                            <td>
                                                <a href="{{ route('data.edit', ['data' => $MobileData->id]) }}"
                                                    type="button"
                                                    class="btn btn-small blue m-5 left waves-effect waves-light"><i
                                                        class="material-icons">edit</i></a>
                                                <form method="POST"
                                                    action="{{ route('data.destroy', ['data' => $MobileData->id]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-small red m-5 left waves-effect waves-light"><i
                                                            class="material-icons">delete_sweep</i></button>
                                                </form>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="6">
                                            <div class="text-right">
                                                <ul class="pagination pagination-split m-t-30"> </ul>
                                            </div>
                                        </td>
                                    </tr>
                                </tfoot>
                            </table>
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
    <script src="{{ asset('dist/js/app.init.js') }}"></script>
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>

    <script src="{{ asset('assets/libs/footable/dist/footable.all.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/footable/footable-init.js') }}"></script>
@endsection
