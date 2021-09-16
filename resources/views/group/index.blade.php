@extends('shared.layout')

@section('PageTitle', (session('Data.company_nature') == 'B' ? 'Group' : 'Classes') . ' List')

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
                <h3 class="font-medium m-b-0">{{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}</h3>
                {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)"
                        class="breadcrumb">{{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}</a>
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

                            <form
                                action="{{ session('Data.company_nature') == 'B' ? route('r.delete-selected-groups') : route('r.delete-selected-classes') }}"
                                method="POST">
                                @csrf
                                @method('DELETE')
                                <table id="demo-foo-addrow2"
                                    class="table table-bordered responsive-table table-hover toggle-circle centered"
                                    data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th data-sort-initial="true" data-toggle="true">ID</th>
                                            <th>
                                                {{ Session::get('Data.company_nature') == 'B' ? 'Group' : 'Class' }} Name
                                            </th>
                                            <th>Status</th>
                                            <th data-sort-ignore="true" class="text-left" style="width: 20%">
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
                                                    <a href="{{ session('Data.company_nature') == 'B' ? route('groups.create') : route('classes.create') }}"
                                                        class="btn btn-small waves-effect waves-light">Add New
                                                        {{ Session::get('Data.company_nature') == 'B' ? 'group' : 'class' }}
                                                    </a>

                                                    <button type="submit"
                                                        class="btn btn-small waves-effect red waves-light">Delete selected
                                                        {{ Session::get('Data.company_nature') == 'B' ? 'groups' : 'classes' }}
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
                                        @php
                                            $Count = 0;
                                        @endphp
                                        @foreach ($Groups as $Group)
                                            <tr>
                                                <td>{{ ++$Count }}</td>
                                                <td>{{ $Group->code }}</td>
                                                <td>{{ $Group->name }}</td>
                                                <td><span class="label label-table label-success">Active</span> </td>
                                                <td class="chktd">
                                                    <div class="row">
                                                        <div class="col s6 m6 l6"><a
                                                                href="{{ session('Data.company_nature') == 'B' ? route('groups.edit', ['group' => $Group->id]) : route('classes.edit', ['class' => $Group->id]) }}"
                                                                type="button"
                                                                class="btn btn-small blue m-5 waves-effect waves-light"><i
                                                                    class="material-icons">edit</i></a>
                                                            {{-- <form method="POST"
                                                            action="{{ session('Data.company_nature') == 'B' ? route('groups.destroy', ['group' => $Group->id]) : route('classes.destroy', ['class' => $Group->id]) }}">
                                                            @csrf
                                                            @method('DELETE')
                                                            <button type="submit" onclick="return confirm('Are you sure?')"
                                                            class="btn btn-small red m-5 left waves-effect waves-light"><i
                                                                    class="material-icons">delete_sweep</i></button>

                                                                </form> --}}
                                                        </div>
                                                        <div class="col s6 m6 l6">
                                                            <p class="m-t-10 multidelchk">
                                                                <label>
                                                                    <input type="checkbox" class="chkbox filled-in"
                                                                        name="group_ids[]" value="{{ $Group->id }}" />
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
                                            <td colspan="5">
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
        $(".sl-all").on('click', function() {
            $('.chkbox').prop('checked', this.checked);
        });
    </script>
@endsection
