@extends('shared.layout')

@section('PageTitle', (session('Data.company_nature') == 'B' ? 'Group' : 'Classes') . ' List')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')

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
                            <div>
                                <a href="{{ session('Data.company_nature') == 'B' ? route('r.delete-all-groups') : route('r.delete-all-classes') }}"
                                    class="btn btn-small waves-effect red waves-light right" id="delete-all">Delete all</a>
                            </div>
                            <form
                                action="{{ session('Data.company_nature') == 'B' ? route('groups.destroy', ['group' => '0']) : route('classes.destroy', ['class' => '0']) }}"
                                method="POST">
                                @csrf
                                @method('DELETE')

                                <table class="striped highlight centered m-t-20">
                                    <thead>
                                        <tr>
                                            <th>Sr No</th>
                                            <th data-sort-initial="true" data-toggle="true">Code</th>
                                            <th>
                                                {{ Session::get('Data.company_nature') == 'B' ? 'Group' : 'Class' }} Name
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
                                        @forelse ($groups as $group)
                                            <tr>
                                                <td>{{ ++$Count }}</td>
                                                <td>{{ $group->code }}</td>
                                                <td>{{ $group->name }}</td>
                                                <td><span class="label label-table label-success">Active</span> </td>
                                                <td class="chktd">
                                                    <div class="row">
                                                        <div class="col s6 m6 l6">
                                                            <a href="{{ session('Data.company_nature') == 'B' ? route('groups.edit', ['group' => encryptParams($group->id) ]) : route('classes.edit', ['class' => encryptParams($group->id) ]) }}"
                                                                type="button"
                                                                class="btn btn-small blue m-5 waves-effect waves-light"><i
                                                                    class="material-icons">edit</i></a>
                                                        </div>
                                                        <div class="col s6 m6 l6">
                                                            <p class="m-t-10 multidelchk">
                                                                <label>
                                                                    <input type="checkbox" class="chkbox filled-in"
                                                                        name="group_ids[]" value="{{ encryptParams($group->id) }}" />
                                                                    <span>&nbsp;</span>
                                                                </label>
                                                            </p>
                                                        </div>
                                                    </div>
                                                </td>
                                            </tr>
                                        @empty
                                            <tr>
                                                <td colspan="5">No data found.</td>
                                            </tr>
                                        @endforelse
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="3">
                                                {{ $groups->onEachSide(2)->links('components.pagination') }}
                                            </td>
                                            <td colspan="3">
                                                <div style="text-align: right">
                                                    [{{ $groups->firstItem() }} ~ {{ $groups->lastItem() }}] out of
                                                    {{ $groups->total() }}

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
                title: "Do you want to delete all {{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}?",
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
