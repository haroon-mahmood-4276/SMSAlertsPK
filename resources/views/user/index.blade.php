@extends('shared.layout')

@section('PageTitle', 'User List')

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
            <h3 class="font-medium m-b-0">SMS History</h3>
            {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
            <div class="custom-breadcrumb ml-auto">
                <a href="{{route('r.dashboard')}}" class="breadcrumb">Dashboard</a>
                <a href="javascript:void(0)" class="breadcrumb">SMS History</a>
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
                            class="table table-bordered responsive-table table-hover toggle-circle" data-page-size="10">
                            <thead>
                                <tr>
                                    <th data-sort-initial="true" data-toggle="true">No</th>
                                    <th>ID</th>
                                    <th>Name</th>
                                    <th>Email</th>
                                    <th>Company</th>
                                    <th>Mask ID</th>
                                    <th>Company Email</th>
                                    <th>Mobile 1</th>
                                    <th data-hide="phone">Actions</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                $Count = 0;
                                @endphp
                                @foreach ($Users as $User)
                                <tr>
                                    <td>{{++$Count}}</td>
                                    <td>{{$User->code}}</td>
                                    <td>{{$User->first_name}} {{$User->last_name}}</td>
                                    <td>{{$User->email}}</td>
                                    <td>{{$User->company_name}}</td>
                                    <td>{{$User->company_mask_id}}</td>
                                    <td>{{$User->company_email}}</td>
                                    <td>{{$User->mobile_1}}</td>
                                    <td>
                                        <a href="{{route("users.edit", ['user' => $User->ids])}}" type="button"
                                            class="btn btn-small blue m-5 left waves-effect waves-light"><i
                                                class="material-icons">edit</i></a>
                                        <form method="POST" action="{{route("users.destroy", ['user' => $User->ids])}}">
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
                                    <td colspan="8">
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
