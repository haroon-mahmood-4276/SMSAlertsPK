@extends('shared.layout')

@section('PageTitle', 'Groups List')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
<link href="{{asset('assets/libs/footable/css/footable.core.css')}}" rel="stylesheet">
<link href="{{asset('dist/css/pages/footable-page.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper">
    <!-- ============================================================== -->
    <!-- Title and breadcrumb -->
    <!-- ============================================================== -->
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h3 class="font-medium m-b-0">{{(session('Data.company_nature') == 'B') ? 'Groups' : 'Classes'}}</h3>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{route('r.dashboard')}}" class="breadcrumb">Dashboard</a>
                <a href="javascript:void(0)"
                    class="breadcrumb">{{(session('Data.company_nature') == 'B') ? 'Groups' : 'Classes'}}</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col s12">
                <div class="card">
                    <div class="card-content">
                        <div class="col s12 l6">
                            Show &nbsp;
                            <div class="input-field inline">
                                <select id="demo-show-entries">
                                    <option value="10">10</option>
                                    <option value="15">15</option>
                                    <option value="20">20</option>
                                    <option value="25">25</option>
                                    <option value="30">30</option>
                                    <option value="35">35</option>
                                    <option value="40">40</option>
                                    <option value="45">45</option>
                                    <option value="50">50</option>
                                </select>
                            </div>
                            &nbsp; entries
                        </div>
                        <table id="demo-foo-pagination" class="table table-bordered table-hover toggle-circle"
                            data-page-size="10">
                            <thead>
                                <tr>
                                    <th data-sort-initial="true" data-toggle="true">First Name</th>
                                    <th>Last Name</th>
                                    <th data-hide="phone">Job Title</th>
                                    <th data-hide="phone">DOB</th>
                                    <th data-hide="phone">Status</th>
                                    <th data-sort-ignore="true" class="min-width">Delete</th>
                                </tr>
                            </thead>
                            <div class="m-t-40">
                                <div class="d-flex">
                                    <div class="mr-auto">
                                        <div class="form-group">
                                            <button id="demo-btn-addrow" class="btn btn-small"><i class="icon wb-plus"
                                                    aria-hidden="true"></i>Add New Row
                                            </button>
                                            <small>New row will be added in last page.</small> </div>
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
                                <tr>
                                    <td>
                                        <div class="chip">
                                            <img src="../../assets/images/users/5.jpg" alt="Contact Person"> Jane Doe
                                        </div>
                                    </td>
                                    <td>
                                        <div class="chip">
                                            <img src="../../assets/images/users/5.jpg" alt="Contact Person"> Jane Doe
                                        </div>
                                    </td>
                                    <td>Airline Transport Pilot</td>
                                    <td>3 Oct 2017</td>
                                    <td><span class="label label-table label-success">Active</span> </td>
                                    <td>
                                        <button type="button" class="btn btn-small btn-outline delete-row-btn"><i
                                                class="ti-close" aria-hidden="true"></i></button>
                                    </td>
                                </tr>
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="6">
                                        <div class="text-right">
                                            <ul class="pagination">
                                            </ul>
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
<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('dist/js/materialize.min.js')}}"></script>
<script src="{{asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('dist/js/app.js')}}"></script>
<script src="{{asset('dist/js/app.init.js')}}"></script>
<script src="{{asset('dist/js/app-style-switcher.js')}}"></script>
<script src="{{asset('dist/js/custom.min.js')}}"></script>

<script src="{{asset('assets/libs/footable/dist/footable.all.min.js')}}"></script>
<script src="{{asset('dist/js/pages/footable/footable-init.js')}}"></script>
@endsection