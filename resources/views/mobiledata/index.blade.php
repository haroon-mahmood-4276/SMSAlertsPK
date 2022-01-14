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
                                    <div class="right">
                                        <form action="{{ route('data.index') }}">
                                            <div class="input-field inline">
                                                <select class="form-select inline" name="group_id"
                                                    onchange="this.form.submit()">
                                                    <option value="">All</option>
                                                    @foreach ($Groups as $Group)
                                                        <option value="{{ $Group->id }}"
                                                            {{ $Group->id == $Current_Code ? 'selected' : '' }}>
                                                            {{ $Group->name }}</option>
                                                    @endforeach
                                                </select>
                                                <label for="group_name"
                                                    class="form-label">{{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <form
                                action="{{ session('Data.company_nature') == 'B' ? route('data.destroy', ['data' => '0']) : route('data.destroy', ['data' => '0']) }}"
                                method="POST"> @csrf
                                @method('DELETE')
                                <table id="demo-foo-addrow2" class="table m-b-0 responsive-table toggle-arrow-tiny"
                                    data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">Code</th>
                                            <th data-hide="phone">Name</th>
                                            @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                <th data-hide="phone">Parent Name</th>
                                            @endif
                                            <th data-hide="phone">
                                                {{ session('Data.company_nature') == 'B' ? '' : 'Parent' }}
                                                Primary Number</th>
                                            <th
                                                data-hide="{{ session('Data.company_nature') == 'B' ? 'phone' : 'all' }}">
                                                {{ session('Data.company_nature') == 'B' ? '' : 'Parent' }}
                                                Secondary Number
                                            </th>
                                            <th data-sort-initial="true" data-toggle="true" data-hide="phone">
                                                {{ session('Data.company_nature') == 'B' ? 'Group' : 'Class - Section' }}
                                            </th>
                                            @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                <th data-hide="all">Student Primary Number</th>
                                                <th data-hide="all">Student Secondary Number</th>
                                            @endif
                                            <th data-hide="all">Date of Birth</th>
                                            {{-- <th data-hide="all">CNIC</th> --}}
                                            <th data-hide="all">Gender</th>
                                            <th data-hide="all">Card Number</th>
                                            <th data-hide="phone">Stauts</th>
                                            <th data-sort-ignore="true" class="text-left" style="width: 10%">
                                                <div class="row">
                                                    <div class="col s6 m6 l6">Actions</div>
                                                    <div class="col s6 m6 l6">
                                                        <p>
                                                            <label>
                                                                <input type="checkbox" class="sl-all filled-in" />
                                                                <span>&nbsp;</span>
                                                            </label>
                                                        </p>
                                                    </div>
                                                </div>
                                            </th>
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

                                                    <button type="submit"
                                                        class="btn btn-small waves-effect red waves-light">Delete selected
                                                        {{ Session::get('Data.company_nature') == 'B' ? 'Members' : 'Students' }}
                                                    </button>
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
                                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                    <td>{{ $MobileData->parent_first_name }}
                                                        {{ $MobileData->parent_last_name }}
                                                    </td>
                                                @endif
                                                <td>{{ $MobileData->parent_mobile_1 }}</td>
                                                <td>{{ $MobileData->parent_mobile_2 }}</td>
                                                <td>{{ $MobileData->group_name }} @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                        - {{ $MobileData->section_name }}
                                                    @endif
                                                </td>
                                                @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                    <td>{{ $MobileData->student_mobile_1 }}</td>
                                                    <td>{{ $MobileData->student_mobile_2 }}</td>
                                                @endif
                                                <td>{{ $MobileData->dob }}</td>
                                                {{-- <td>{{ $MobileData->cnic }}</td> --}}
                                                <td>{{ $MobileData->gender }}</td>
                                                <td>{{ $MobileData->card_number }}</td>
                                                <td>
                                                    @if ($MobileData->active == 'Y')
                                                        <span class="label label-table label-success">Active</span>
                                                    @else
                                                        <span class="label label-table label-danger">Not Active</span>
                                                    @endif
                                                </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col s6 m6 l6">
                                                            <a href="{{ route('data.edit', ['data' => $MobileData->id]) }}"
                                                                type="button"
                                                                class="btn btn-small blue m-5 left waves-effect waves-light"><i
                                                                    class="material-icons">edit</i></a>
                                                        </div>
                                                        <div class="col s6 m6 l6">
                                                            <p class="m-t-10 multidelchk">
                                                                <label>
                                                                    <input type="checkbox" class="chkbox filled-in"
                                                                        name="members_ids[]"
                                                                        value="{{ $MobileData->id }}" />
                                                                    <span>&nbsp;</span>
                                                                </label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="7">
                                                <div class="text-right">
                                                    <ul class="pagination pagination-split"> </ul>
                                                </div>
                                            </td>
                                        </tr>
                                    </tfoot>
                                </table>
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
        $(".sl-all").on('click', function() {
            $('.chkbox').prop('checked', this.checked);
        });
    </script>
@endsection
