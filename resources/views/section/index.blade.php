@extends('shared.layout')

@section('PageTitle', 'Sections List')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
<link href="{{asset('assets/libs/footable/css/footable.core.css')}}" rel="stylesheet">
<link href="{{asset('dist/css/pages/footable-page.css')}}" rel="stylesheet">
@endsection

@section('content')
<div class="page-wrapper">
    <div class="page-titles">
        <div class="d-flex align-items-center">
            <h3 class="font-medium m-b-0">Sections</h3>
            {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
            <div class="custom-breadcrumb ml-auto">
                <a href="{{route('r.dashboard')}}" class="breadcrumb">Dashboard</a>
                <a href="javascript:void(0)"
                    class="breadcrumb">Sections</a>
            </div>
        </div>
    </div>

    <div class="container-fluid">
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        @if (Session::has("AlertType") && Session::has("AlertMsg"))
                        <div class="row">
                            <div class="col l12 m12 s12 m-5">
                                <div class="{{Session::get("AlertType")}}-alert-bar p-15 m-b-20 white-text">
                                    {{Session::get("AlertMsg")}}
                                </div>
                            </div>
                        </div>
                        @endif

                        <table id="demo-foo-addrow2"
                            class="table table-bordered highlight responsive-table" data-page-size="10">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>ID</th>
                                    <th>Section Name</th>
                                    <th data-sort-initial="true" data-toggle="true">Class Name</th>
                                    <th>Status</th>
                                    <th data-sort-ignore="true" class="min-width text-left">Actions</th>
                                </tr>
                            </thead>
                            <div class="m-t-5">
                                <div class="d-flex">
                                    <div class="mr-auto">
                                        <div class="form-group">
                                            <a href="{{route("sections.create")}}" class="btn btn-small"><i
                                                    class="icon wb-plus waves-effect waves-light"
                                                    aria-hidden="true"></i>Add New Section</a>
                                            </a>
                                            {{-- <small>New row will be added in last page.</small> --}}
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
                                @php
                                $Count = 0;
                                @endphp
                                @foreach ($Sections as $Section)
                                <tr>
                                    <td>{{++$Count}}</td>
                                    <td>{{$Section->code}}</td>
                                    <td>{{$Section->name}}</td>
                                    <td>{{$Section->group_name}}</td>
                                    <td><span class="label label-table label-success">Active</span> </td>
                                    <td>
                                        <a href="{{route("sections.edit", ['section' => $Section->id])}}" type="button"
                                            class="btn btn-small blue m-5 left waves-effect waves-light"><i
                                                class="material-icons">edit</i></a>
                                        <form method="POST"
                                            action="{{route("sections.destroy", ['section' => $Section->id])}}">
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
