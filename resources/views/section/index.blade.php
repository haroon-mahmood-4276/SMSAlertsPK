@extends('shared.layout')

@section('PageTitle', 'Sections List')

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
                <h3 class="font-medium m-b-0">Sections</h3>
                {{-- <h4 class="font-medium m-b-0">{{$Sections->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">Sections</a>
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
                                <a href="{{ route('r.delete-all-sections') }}"
                                    class="btn btn-small waves-effect red waves-light right"
                                    onclick="return confirm('Are you sure you want to delete all the data?')">Delete all</a>
                            </div>
                            <form action="{{ route('sections.destroy', ['section' => '0']) }}" method="POST">
                                @csrf
                                @method('DELETE')

                                <table class="striped highlight centered m-t-20">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th data-sort-initial="true" data-toggle="true">Code</th>
                                            <th>
                                                Section Name
                                            </th>
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
                                                    <a href="{{ route('sections.create') }}"
                                                        class="btn btn-small waves-effect waves-light">Add New Section
                                                    </a>

                                                    <button type="submit"
                                                        class="btn btn-small waves-effect red waves-light">Delete selected
                                                        sections
                                                    </button>


                                                </div>
                                            </div>
                                            {{-- <div class="ml-auto">
                                                <div class="form-group">
                                                    <input id="demo-input-search2" type="text" placeholder="Search"
                                                        autocomplete="off">
                                                </div>
                                            </div> --}}
                                        </div>
                                    </div>

                                    <tbody>
                                        @php
                                            $Count = 0;
                                        @endphp
                                        @foreach ($Sections as $Section)
                                            <tr>
                                                <td>{{ ++$Count }}</td>
                                                <td>{{ $Section->code }}</td>
                                                <td>{{ $Section->name }}</td>
                                                <td><span class="label label-table label-success">Active</span> </td>
                                                <td class="chktd">
                                                    <div class="row">
                                                        <div class="col s6 m6 l6">
                                                            <a href="{{ route('sections.edit', ['section' => $Section->id]) }}"
                                                                type="button"
                                                                class="btn btn-small blue m-5 waves-effect waves-light"><i
                                                                    class="material-icons">edit</i></a>
                                                        </div>
                                                        <div class="col s6 m6 l6">
                                                            <p class="m-t-10 multidelchk">
                                                                <label>
                                                                    <input type="checkbox" class="chkbox filled-in"
                                                                        name="group_ids[]" value="{{ $Section->id }}" />
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
                                            <td colspan="3">
                                                {{ $Sections->onEachSide(2)->links('shared.pagination') }}
                                            </td>
                                            <td colspan="3">
                                                [{{ $Sections->firstItem() }} ~ {{ $Sections->lastItem() }}] out of
                                                {{ $Sections->total() }}
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
    {{-- <script src="{{ asset('dist/js/app.init.js')}}"></script> --}}
    <script src="{{ asset('dist/js/app-style-switcher.js') }}"></script>
    <script src="{{ asset('dist/js/custom.min.js') }}"></script>
    <!--c3 JavaScript -->
    <script src="{{ asset('assets/extra-libs/c3/d3.min.js') }}"></script>
    <script src="{{ asset('assets/extra-libs/c3/c3.min.js') }}"></script>


    <script src="{{ asset('assets/libs/footable/dist/footable.all.min.js') }}"></script>
    <script src="{{ asset('dist/js/pages/footable/footable-init.js') }}"></script>
    <script>
        $(".sl-all").on('click', function() {
            $('.chkbox').prop('checked', this.checked);
        });
    </script>
@endsection
