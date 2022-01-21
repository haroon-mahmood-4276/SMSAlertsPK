@extends('shared.layout')

@section('PageTitle', @(session('Data.company_nature') == 'B') ? 'Members' : 'Students' . ' List')

@section('CSS')
@endsection

@section('content')
    <div class="page-wrapper">
        <div class="page-titles">
            <div class="d-flex align-items-center">
                <h3 class="font-medium m-b-0">{{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}</h3>
                {{-- <h4 class="font-medium m-b-0">{{$Groups->company_name}}</h4> --}}
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)"
                        class="breadcrumb">{{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}</a>
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
                                    <div class="left">
                                        <div class="form-group">
                                            <input id="demo-input-search2" type="text" placeholder="Search"
                                                autocomplete="off">
                                        </div>
                                    </div>
                                    <div class="right">
                                        <form action="{{ route('data.index') }}">
                                            <div class="input-field inline">
                                                <select class="form-select inline" name="group_id"
                                                    onchange="this.form.submit()">
                                                    <option value="">All</option>
                                                    @if (isset($groups))
                                                        @foreach ($groups as $group)
                                                            <option value="{{ $group->id }}"
                                                                {{ $group->id == $group_id ? 'selected' : '' }}>
                                                                {{ $group->name }}</option>
                                                        @endforeach
                                                    @endif
                                                </select>
                                                <label for="group_name"
                                                    class="form-label">{{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}</label>
                                            </div>
                                        </form>
                                    </div>
                                </div>
                            </div>
                            <div>
                                <a href="{{ session('Data.company_nature') == 'B' ? route('r.delete-all-members') : route('r.delete-all-students') }}"
                                    class="btn btn-small waves-effect red waves-light right" id="delete-all">Delete all</a>
                            </div>
                            <form
                                action="{{ session('Data.company_nature') == 'B' ? route('data.destroy', ['data' => '0']) : route('data.destroy', ['data' => '0']) }}"
                                method="POST"> @csrf
                                @method('DELETE')
                                <table id="demo-foo-addrow2" class="table m-b-0 responsive-table toggle-arrow-tiny"
                                    data-page-size="10">
                                    <thead>
                                        <tr>
                                            <th data-toggle="true">Code</th>
                                            <th data-hide="phone">Name</th>
                                            @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                <th data-hide="phone">Parent Name</th>
                                            @endif
                                            <th data-hide="phone">
                                                {{ session('Data.company_nature') == 'B' ? '' : 'Parent' }}
                                                Primary Number</th>
                                            <th
                                                data-hide="{{ session('Data.company_nature') == 'B' ? 'phone' : 'all' }}">
                                                {{ session('Data.company_nature') == 'B' ? '' : 'Parent' }}
                                                Secondary Number
                                            </th>
                                            <th data-sort-initial="true" data-toggle="true" data-hide="phone">
                                                {{ session('Data.company_nature') == 'B' ? 'Group' : 'Class - Section' }}
                                            </th>
                                            @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                <th data-hide="all">Student Primary Number</th>
                                                <th data-hide="all">Student Secondary Number</th>
                                            @endif
                                            <th data-hide="all">Date of Birth</th>
                                            {{-- <th data-hide="all">CNIC</th> --}}
                                            <th data-hide="all">Gender</th>
                                            <th data-hide="all">Card Number</th>
                                            <th data-hide="phone">Stauts</th>
                                            <th data-sort-ignore="true" class="text-left" style="width: 10%">
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
                                                    <a href="{{ route('data.create') }}" class="btn btn-small"><i
                                                            class="icon wb-plus waves-effect waves-light"
                                                            aria-hidden="true"></i>Add New
                                                        {{ Session::get('Data.company_nature') == 'B' ? 'Member' : 'Student' }}
                                                    </a>

                                                    <button type="submit"
                                                        class="btn btn-small waves-effect red waves-light">Delete selected
                                                        {{ Session::get('Data.company_nature') == 'B' ? 'Members' : 'Students' }}
                                                    </button>
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <tbody>
                                        @if (isset($members))
                                            @forelse ($members as $member)
                                                <tr>

                                                    <td>{{ $member->code }}</td>
                                                    <td>{{ $member->student_first_name }}
                                                        {{ $member->student_last_name }}
                                                    </td>
                                                    @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                        <td>{{ $member->parent_first_name }}
                                                            {{ $member->parent_last_name }}
                                                        </td>
                                                    @endif
                                                    <td>{{ $member->parent_mobile_1 }}</td>
                                                    <td>{{ $member->parent_mobile_2 }}</td>
                                                    <td>{{ $member->group_name }} @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                            - {{ $member->section_name }}
                                                        @endif
                                                    </td>
                                                    @if (session('Data.company_nature') == 'S' || session('Data.company_nature') == 'HE')
                                                        <td>{{ $member->student_mobile_1 }}</td>
                                                        <td>{{ $member->student_mobile_2 }}</td>
                                                    @endif
                                                    <td>{{ $member->dob }}</td>
                                                    {{-- <td>{{ $member->cnic }}</td> --}}
                                                    <td>{{ $member->gender }}</td>
                                                    <td>{{ $member->card_number }}</td>
                                                    <td>
                                                        @if ($member->active == 'Y')
                                                            <span class="label label-table label-success">Active</span>
                                                        @else
                                                            <span class="label label-table label-danger">Not Active</span>
                                                        @endif
                                                    </td>
                                                    <td>
                                                        <div class="row">
                                                            <div class="col s6 m6 l6">
                                                                <a href="{{ route('data.edit', ['data' => encryptParams($member->id)]) }}"
                                                                    type="button"
                                                                    class="btn btn-small blue m-5 left waves-effect waves-light"><i
                                                                        class="material-icons">edit</i></a>
                                                            </div>
                                                            <div class="col s6 m6 l6">
                                                                <p class="m-t-10 multidelchk">
                                                                    <label>
                                                                        <input type="checkbox" class="chkbox filled-in"
                                                                            name="members_ids[]"
                                                                            value="{{ encryptParams($member->id) }}" />
                                                                        <span>&nbsp;</span>
                                                                    </label>
                                                                </p>
                                                            </div>
                                                        </div>
                                                    </td>
                                                </tr>
                                            @empty
                                                <tr>
                                                    <td colspan="7">Data not found.</td>
                                                </tr>
                                            @endforelse
                                        @endif
                                    </tbody>
                                    <tfoot>
                                        @if (isset($members))
                                            <tr>
                                                <td colspan="3">
                                                    {{ $members->onEachSide(2)->links('components.pagination') }}
                                                </td>
                                                <td colspan="4">
                                                    <div style="text-align: right">
                                                        [{{ $members->firstItem() }} ~ {{ $members->lastItem() }}] out
                                                        of
                                                        {{ $members->total() }}

                                                    </div>
                                                </td>
                                            </tr>
                                        @endif
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
    <script>
        $(".sl-all").on('click', function() {
            $('.chkbox').prop('checked', this.checked);
        });

        $('#delete-all').on('click', function(e) {
            e.preventDefault();
            var hrefLink = $(this).attr('href');
            Swal.fire({
                allowOutsideClick: false,
                showConfirmButton: true,
                showDenyButton: true,
                allowEscapeKey: true,
                allowEnterKey: true,
                buttonsStyling: false,
                title: "Do you want to delete all {{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}?",
                backdrop: true,
                confirmButtonText: 'Yes',
                denyButtonText: 'No',
                customClass: {
                    popup: 'rounded-5 p-t-3',
                    confirmButton: 'btn btn-primary m-10',
                    denyButton: 'btn btn-danger m-10',
                }
            }).then(function(dialogue) {
                if (dialogue.isConfirmed) {
                    window.location.href = hrefLink;
                }
            });
        });
    </script>
@endsection
