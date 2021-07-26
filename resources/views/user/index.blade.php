@extends('shared.layout')

@section('PageTitle', 'Users List')

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
                <h3 class="font-medium m-b-0">Users</h3>
                {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">Users</a>
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
                                        <form action="{{ route('users.index') }}">
                                            <div class="input-field inline">
                                                <select class="form-select inline" name="user_type"
                                                    onchange="this.form.submit()">
                                                    <option value="">All</option>
                                                    <option value="B" {{ $Selection == 'B' ? 'selected' : '' }}>Business
                                                        Users</option>
                                                    <option value="S" {{ $Selection == 'S' ? 'selected' : '' }}>School
                                                        Users</option>
                                                </select>
                                                <label for="group_name" class="form-label">Users</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <table id="demo-foo-addrow2" class="table m-b-0 toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">Code</th>
                                        <th data-hide="phone">Name</th>
                                        <th data-hide="all">Email</th>
                                        <th data-hide="phone">Company Name</th>
                                        <th data-hide="phone">Primary Number</th>
                                        <th data-hide="phone">Remaining SMS</th>
                                        <th data-hide="all">Total SMS</th>
                                        <th data-hide="phone">Expiry Date</th>
                                        <th data-hide="all">Company Mask</th>
                                        <th data-hide="all">Company Email</th>
                                        <th data-hide="all">Company Nature</th>
                                        <th data-hide="all">Secondary Number</th>
                                        <th data-hide="phone">Actions</th>
                                    </tr>
                                </thead>
                                <div class="m-t-5">
                                    <div class="d-flex">
                                        <div class="mr-auto">
                                            <div class="form-group">
                                                <a href="{{ route('users.create') }}" class="btn btn-small">
                                                    Add New User
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
                                    @foreach ($Users as $User)
                                        <tr>
                                            <td>{{ $User->code }}</td>
                                            <td>{{ $User->first_name }}
                                                {{ $User->last_name }}
                                            </td>
                                            <td>{{ $User->email }}</td>
                                            <td>{{ $User->company_name }}</td>
                                            <td>{{ $User->mobile_1 }}</td>
                                            <td>{{ $User->remaining_of_sms }}</td>
                                            <td>{{ $User->no_of_sms }}</td>
                                            <td>{{ $User->expiry_date }}</td>
                                            <td>{{ $User->company_mask_id }}</td>
                                            <td>{{ $User->company_email }}</td>
                                            <td>{{ $User->company_nature == 'B' ? 'Business' : 'School' . ' User' }}</td>
                                            <td>{{ $User->mobile_2 }}</td>
                                            <td>
                                                <a href="{{ route('r.showaddpackage', ['package' => $User->id]) }}" type="button"
                                                    class="btn btn-small blue m-5 left waves-effect waves-light">Add
                                                    Package</a>
                                                <a href="{{ route('users.edit', ['user' => $User->id]) }}" type="button"
                                                    class="btn btn-small blue m-5 left waves-effect waves-light"><i
                                                        class="material-icons">edit</i></a>
                                                <form method="POST"
                                                    action="{{ route('users.destroy', ['user' => $User->id]) }}">
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
                                        <td colspan="7">
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
