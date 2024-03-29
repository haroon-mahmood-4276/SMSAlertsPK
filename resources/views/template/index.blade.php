@extends('shared.layout')

@section('PageTitle', 'Templates List')

@section('CSS')
    <link href="{{ asset('assets/libs/footable/css/footable.core.css') }}" rel="stylesheet">
    <link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-titles">
            <div class="d-flex align-items-center">
                <h3 class="font-medium m-b-0">Templates</h3>
                {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">Templates</a>
                </div>
            </div>
        </div>

        <div class="container-fluid">
            <div class="card">
                <div class="card-content">
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
                            <div>
                                <a href="{{ route('r.delete-all-templates') }}"
                                   class="btn btn-small waves-effect red waves-light right" id="delete-all">Delete all</a>
                            </div>
                            <form action="{{ route('templates.destroy', ['template' => '0']) }}" method="POST">
                                @csrf
                                @method('DELETE')
                                <table id="demo-foo-addrow2"
                                    class="table table-bordered responsive-table table-hover toggle-circle"
                                    data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th data-sort-initial="true" data-toggle="true">Sr No</th>
                                            <th>Name</th>
                                            <th style="width: 50%;">Template</th>
                                            <th>Status</th>
                                            <th data-sort-ignore="true" class="text-left">
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
                                                    <a href="{{ route('templates.create') }}" class="btn btn-small"><i
                                                            class="icon wb-plus waves-effect waves-light"
                                                            aria-hidden="true"></i>Add New Template</a>
                                                    <button type="submit"
                                                            class="btn btn-small waves-effect red waves-light">Delete selected
                                                        templates
                                                    </button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <tbody>
                                        @php
                                            $Count = 0;
                                        @endphp
                                        @foreach ($Templates as $Template)
                                            <tr>
                                                <td>{{ ++$Count }}</td>
                                                <td>{{ $Template->name }}</td>
                                                <td>{{ $Template->template }}</td>
                                                <td><span class="label label-table label-success">Active</span> </td>
                                                <td>
                                                    <div class="row">
                                                        <div class="col s6 m6 l6">
                                                            <a href="{{ route('templates.edit', ['template' => encryptParams($Template->id)]) }}"
                                                                type="button"
                                                                class="btn btn-small blue m-5 left waves-effect waves-light"><i
                                                                    class="material-icons">edit</i></a>
                                                        </div>
                                                        <div class="col s6 m6 l6">
                                                            <p class="m-t-10 multidelchk">
                                                                <label>
                                                                    <input type="checkbox" class="chkbox filled-in"
                                                                        name="template_ids[]"
                                                                        value="{{ encryptParams($Template->id) }}" />
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
                                            <td colspan="6">
                                                <div class="text-right">
                                                    <ul class="pagination">
                                                    </ul>
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
        $(document).ready(function () {
            $(".sl-all").on('click', function() {
                $('.chkbox').prop('checked', this.checked);
            });

            $("#search").on("keyup", function() {
                let value = $(this).val().toLowerCase();
                $("#demo-foo-addrow2 tbody tr").filter(function() {
                    $(this).toggle($(this).text().toLowerCase().indexOf(value) > -1)
                });
            });
        });


    </script>
@endsection
