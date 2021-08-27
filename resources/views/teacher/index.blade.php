@extends('shared.layout')

@section('PageTitle', 'Teacher List')

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
                <h3 class="font-medium m-b-0">Teachers</h3>
                {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)"
                        class="breadcrumb">Teachers</a>
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
                                </div>
                            </div>
                            <table id="demo-foo-addrow2" class="table m-b-0 responsive-table toggle-arrow-tiny" data-page-size="10">
                                <thead>
                                    <tr>
                                        <th data-toggle="true">Code</th>
                                        <th data-hide="phone">Name</th>
                                        <th data-hide="phone">Email</th>
                                        <th data-hide="phone">Primary Number</th>
                                        <th data-hide="phone">Assigned for</th>
                                        <th data-hide="all">Secondary Number</th>
                                        <th data-hide="phone">Coodinator Number</th>
                                        <th data-hide="phone">Stauts</th>
                                        <th data-hide="phone">Actions</th>
                                    </tr>
                                </thead>
                                <div class="m-t-5">
                                    <div class="d-flex">
                                        <div class="mr-auto">
                                            <div class="form-group">
                                                <a href="{{ route('teachers.create') }}" class="btn btn-small"><i
                                                        class="icon wb-plus waves-effect waves-light"
                                                        aria-hidden="true"></i>Add New Teacher
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
                                    @foreach ($Teachers as $Teacher)
                                        <tr>

                                            <td>{{ $Teacher->code }}</td>
                                            <td>{{ $Teacher->first_name }}
                                                {{ $Teacher->last_name }}
                                            </td>
                                            <td>{{ $Teacher->email }}</td>
                                            <td>{{ $Teacher->mobile_1 }}</td>
                                            <td>{{ $Teacher->group_name }} - {{ $Teacher->subject_name }}</td>
                                            <td>{{ $Teacher->mobile_2 }}</td>
                                            <td>{{ $Teacher->coodinator_number }}</td>
                                            <td>
                                                @if ($Teacher->active == 'Y')
                                                    <span class="label label-table label-success">Active</span>
                                                @else
                                                    <span class="label label-table label-danger">Not Active</span>
                                                @endif
                                            </td>
                                            <td>
                                                <a href="{{ route('teachers.edit', ['teacher' => $Teacher->code]) }}"
                                                    type="button"
                                                    class="btn btn-small blue m-5 left waves-effect waves-light"><i
                                                        class="material-icons">edit</i></a>
                                                {{-- <form method="POST"
                                                    action="{{ route('teachers.destroy', ['teacher' => $Teacher->code]) }}">
                                                    @csrf
                                                    @method('DELETE')
                                                    <button type="submit" onclick="return confirm('Are you sure?')"
                                                        class="btn btn-small red m-5 left waves-effect waves-light"><i
                                                            class="material-icons">delete_sweep</i></button>
                                                </form> --}}
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
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>

    <script src="{{ asset('assets/libs/footable/dist/footable.all.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/footable/footable-init.js') }}"></script>
@endsection
