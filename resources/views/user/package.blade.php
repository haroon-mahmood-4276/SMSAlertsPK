@extends('shared.layout')

@section('PageTitle', 'Add Package')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
    <link rel="stylesheet" type="text/css"
        href="{{ asset('assets/libs/bootstrap-material-datetimepicker/css/bootstrap-material-datetimepicker.css') }}">
@endsection

@section('content')
    <div class="page-wrapper">
            <div class="container-fluid row">
            <div class="col l12 m12 s12">
                <div class="card">
                    <div class="card-content">
                        @if (Session::has('AlertType') && Session::has('AlertMsg'))
                            <div class="row">
                                <div class="col l12 m12 s12 m-5">
                                    <div class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                                        {{ Session::get('AlertMsg') }}
                                    </div>
                                </div>
                            </div>
                        @endif
                        <table id="demo-foo-addrow2" class="table table-bordered responsive-table table-hover toggle-circle"
                            data-page-size="10">
                            <thead>
                                <tr>
                                    <th>Sr No</th>
                                    <th>No of SMS</th>
                                    <th>Expiry Date</th>
                                    <th>Purchase Date</th>
                                </tr>
                            </thead>
                            <tbody>
                                @php
                                    $Count = 0;
                                @endphp
                                @foreach ($Packages as $Package)
                                    <tr>
                                        <td>{{ ++$Count }}</td>
                                        <td>{{ $Package->no_of_sms }}</td>
                                        <td>{{ $Package->expiry_date }}</td>
                                        <td>{{ $Package->created_at }}</td>
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
                    </div>
                </div>
                <div class="card">
                    <div class="card-content">
                        <h5 class="card-title">Add Package</h5>
                        <form class="formValidate" id="formValidate"
                            action="{{ route('r.add-package', ['package' => $UserID]) }}" method="POST">
                            @csrf
                            <div class="row">
                                <div class="input-field col s6">
                                    <i class="material-icons prefix">text_format</i>
                                    <input id="no_of_sms" name="no_of_sms" type="number" min="0"
                                        class="@error('no_of_sms') error @enderror" value="{{ old('no_of_sms') }}">
                                    <label for="no_of_sms">No of SMS*</label>
                                    @error('no_of_sms')
                                        <span style="color: red">{{ $message }}</span>
                                    @enderror
                                </div>


                                <div class="col s6">
                                    <label class="">Expiry Date</label>
                                    <div class="input-fleid">
                                        <input type="text" value="{{ old('expiry_date') }}" id="expiry_date"
                                            name="expiry_date" placeholder="01/01/1999">
                                    </div>
                                    @error('expiry_date')
                                        <span style="color: rgb(255, 0, 0)">{{ $message }}</span>
                                    @enderror
                                </div>
                            </div>

                            <div class="row">
                                <div class="input-field col s12">
                                    <button class="btn waves-effect waves-light right submit" type="submit"
                                        name="action">Save
                                    </button>
                                    <a href="{{ route('users.index') }}"
                                        class="btn waves-effect red waves-light right m-r-10">Back to Users List</a>
                                </div>
                            </div>
                        </form>
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
    <script src="{{ asset('assets/libs/moment/moment.js') }}"></script>
    <script
        src="{{ asset('assets/libs/bootstrap-material-datetimepicker/js/bootstrap-material-datetimepicker-custom.js') }}">
    </script>
    <script>
        $('#expiry_date').bootstrapMaterialDatePicker({
            // format: 'DD/MM/YYYY',
            weekStart: 1,
            time: false
        });
    </script>
@endsection
