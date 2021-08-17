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
        <div class="row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        <table id="zero_config" class="responsive-table striped display" style="width:100%">
                            <thead>
                                <tr>
                                    <th data-sort-initial="true" data-toggle="true">Sr No</th>
                                    <th>Code</th>
                                    <th>Name</th>
                                    <th>
                                        {{ Session::get('Data.company_nature') == 'B' ? 'Group' : 'Class - Section' }}
                                    </th>
                                    <th>Date of Birth</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $Count = 0;
                                @endphp
                                @foreach ($BirthdayData as $Member)
                                    <tr>
                                        <td>{{ ++$Count }}</td>
                                        <td>{{ $Member->code }}</td>
                                        <td>{{ $Member->student_first_name }}
                                            {{ $Member->student_last_name }}
                                        </td>
                                        <td>{{ $Member->group_name }} @if (session('Data.company_nature') == 'S')
                                                - {{ $Member->section_name }}
                                            @endif
                                        </td>
                                        <td>{{ $Member->dob }}</td>
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
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>

    <script src="{{ asset('assets/libs/footable/dist/footable.all.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/footable/footable-init.js') }}"></script>
@endsection
