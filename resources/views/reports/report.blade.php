@extends('reports.layout')

@section('PageTitle', $Title)

@section('BeforeCommonCss')
    <style>
        table,
        th,
        td {
            border-collapse: collapse;
            border: 1px solid #aaa;
            text-align: center !important;
        }

        tr:nth-child(odd) {
            background-color: #f2f2f2;
        }

        tr {
            transition: transform .1s ease-in;
        }

        .card {
            background-color: white !important;
            border-radius: 15px !important;
            box-shadow: rgba(100, 100, 111, 0.2) 0px 7px 29px 0px !important
        }

        tr:hover {
            transform: scale(1.01);
        }

    </style>
@endsection

@section('AfterCommonCss')
    <link href="{{ asset('assets/libs/footable/css/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
@endsection

@section('content')

    <div class="page-titles container m-b-10 m-t-10" style="text-align: center">
        <div class="">
            <h3 class="font-medium m-b-0">{{ $Title }}</h3>
        </div>
    </div>
    <div class="container-fluid">
        <div class="card">
            <div class="card-content">
                <div class="row">
                    <div class="col l12 m12 s12">
                        <table id="zero_config" class="responsive-table striped display" style="width:100%">
                            <thead>
                                <tr>
                                    <th data-sort-initial="false" data-toggle="true">No</th>
                                    <th>SMS</th>
                                    <th>Phone Number</th>
                                    <th>Date</th>
                                    <th>Status</th>
                                </tr>
                            </thead>
                            <div class="m-t-10 m-b-25">
                                <div class="d-flex">
                                    <div class="ml-auto">
                                        <div class="form-group">
                                            <a href="{{ $DownloadLink }}" class="waves-effect waves-light btn"><i
                                                    class="material-icons left">file_download</i>Export as PDF</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <tbody>
                                @php
                                    $Count = 0;
                                @endphp
                                @foreach ($SMSHistoryData as $SMS)
                                    <tr>
                                        <td>{{ ++$Count }}</td>
                                        <td>
                                            {{ $SMS->sms }}</td>
                                        <td>{{ $SMS->phone_number }}</td>
                                        <td>{{ $SMS->created_at }}</td>
                                        <td><span class="label label-table label-success">{{ $SMS->response }}</span>
                                        </td>
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
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
