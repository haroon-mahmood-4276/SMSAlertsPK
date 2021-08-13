@extends('shared.layout')

@section('PageTitle', 'Dashboard')

@section('BeforeCommonCss')
<link href="{{ asset('assets/extra-libs/c3/c3.min.css') }}" rel="stylesheet">
@endsection

@section('AfterCommonCss')
<link href="{{ asset('dist/css/pages/dashboard1.css') }}" rel="stylesheet">
<link href="{{ asset('assets/extra-libs/prism/prism.css') }}" rel="stylesheet">
<link href="{{ asset('assets/libs/footable/css/footable.core.css') }}" rel="stylesheet">
<link href="{{ asset('dist/css/pages/footable-page.css') }}" rel="stylesheet">
@endsection

@section('content')

<div class="page-wrapper">
    <div class="container-fluid">
        @if (Session::has('AlertType') && Session::has('AlertMsg'))
            <div class="row">
                <div class="col l12 m12 s12 m-5">
                    <div class="{{ Session::get('AlertType') }}-alert-bar p-15 m-b-20 white-text">
                        {{ Session::get('AlertMsg') }}
                    </div>
                </div>
            </div>
        @endif
        <div class="row">

            @if (session('Data.company_nature') != 'A')

                <div class="col l4 m6 s12">
                    <div class="card warning-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ Session::get('Data.remaining_of_sms') }}</h2>
                                    <h6 class="white-text op-5">Remaining SMS</h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i
                                            class="material-icons">question_answer</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l4 m6 s12">
                    <div class="card info-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ Session::get('Data.no_of_sms') }}</h2>
                                    <h6 class="white-text op-5">Total SMS</h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i
                                            class="material-icons">question_answer</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l4 m6 s12">
                    <div class="card danger-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">
                                        {{ date_format(new DateTime(Session::get('Data.expiry_date')), 'd/m/Y') }}
                                    </h2>
                                    <h6 class="white-text op-5 light-blue-text">Expiry Date</h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="material-icons">data_usage</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l4 m6 s12">
                    <div class="card danger-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ $GroupCount }}</h2>
                                    <h6 class="white-text op-5 light-blue-text">
                                        {{ session('Data.company_nature') == 'B' ? 'Groups' : 'Classes' }}
                                    </h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="material-icons">portrait</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                @if (session('Data.company_nature') == 'S')
                    <div class="col l4 m6 s12">
                        <div class="card info-gradient card-hover">
                            <div class="card-content">
                                <div class="d-flex no-block align-items-center">
                                    <div>
                                        <h2 class="white-text m-b-5">{{ $SectionCount }}</h2>
                                        <h6 class="white-text op-5 text-darken-2">Sections</h6>
                                    </div>
                                    <div class="ml-auto">
                                        <span class="white-text display-6"><i class="material-icons">group</i></span>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                @endif

                <div class="col l4 m6 s12">
                    <div class="card success-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ $MobileDatasCount }}</h2>
                                    <h6 class="white-text op-5 light-blue-text">
                                        {{ session('Data.company_nature') == 'B' ? 'Members' : 'Students' }}
                                    </h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i
                                            class="material-icons">account_circle</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

            @else
                <div class="col l4 m4 s12">
                    <div class="card danger-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ $GroupCount }}</h2>
                                    <h6 class="white-text op-5 light-blue-text">
                                        Users
                                    </h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="material-icons">group</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l4 m4 s12">
                    <div class="card info-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ $SectionCount }}</h2>
                                    <h6 class="white-text op-5 text-darken-2">Business Users</h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="material-icons">business</i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="col l4 m4 s12">
                    <div class="card success-gradient card-hover">
                        <div class="card-content">
                            <div class="d-flex no-block align-items-center">
                                <div>
                                    <h2 class="white-text m-b-5">{{ $MobileDatasCount }}</h2>
                                    <h6 class="white-text op-5 light-blue-text">
                                        School Users
                                    </h6>
                                </div>
                                <div class="ml-auto">
                                    <span class="white-text display-6"><i class="fas fa-university"></i></span>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            @endif
        </div>

        @if (session('Data.company_nature') != 'A')
            @if ($BirthdayData->count() > 0)
                <div class="row">
                    <div class="col l12 m12 s12">
                        <div class="card">
                            <div class="card-content">
                                <h2>Birthday Section</h2>
                                <table id="demo-foo-addrow2"
                                    class="table table-bordered responsive-table table-hover toggle-circle"
                                    data-page-size="10">
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
                                    <div class="m-t-10 m-b-25">
                                        <div class="d-flex">
                                            <div class="ml-auto">
                                                <div class="form-group">
                                                    <a href="{{ route('r.birthdayreportpdf') }}"
                                                        class="waves-effect waves-light btn"><i
                                                            class="material-icons left">file_download</i>Export as
                                                        PDF</a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
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
                                    <tfoot>
                                        <tr>
                                            <td colspan="4">
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
            @endif
            <div class="row">
                <div class="col l12 m12 s12">
                    <div class="card">
                        <div class="card-content">
                            <h3>SMS API</h3>
                            <div>
                                <p>It is a GET Request API.</p>
                                <pre>
                                    <code class="language-markup">
                                        <span>{{ urldecode(route('api.sms.quick', ['email' => session('Data.email'), 'password' => '*********', 'phone_number' => '923012345678', 'message' => "Hello I'm testing message"])) }}</span>
                                    </code>
                                </pre>

                                <div>
                                    <br>
                                    <h5>Coding Examples</h5>
                                    <ul class="tabs tab-demo z-depth-1">
                                        <li class="tab">
                                            <a class="active" href="#1csdotnet">C# .NET</a>
                                        </li>
                                        <li class="tab">
                                            <a class="" href="#1vbdotnet">VB .NET</a>
                                        </li>
                                    </ul>
                                    <div id="1csdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                WebRequest request = WebRequest.Create("{{ urldecode(route('api.sms.quick', ['email' => session('Data.email'), 'password' => '*********', 'phone_number' => '923012345678', 'message' => "Hello I'm testing message"])) }}");
                                                WebResponse response = request.GetResponse();

                                                Stream dataStream = response.GetResponseStream();
                                                StreamReader reader = new StreamReader(dataStream);

                                                Console.WriteLine("Response: " + reader.ReadToEnd().toString());
                                                response.Close();
                                            </code>
                                        </pre>
                                    </div>
                                    <div id="1vbdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                Dim request As WebRequest = WebRequest.Create("{{ urldecode(route('api.sms.quick', ['email' => session('Data.email'), 'password' => '*********', 'phone_number' => '923012345678', 'message' => "Hello I'm testing message"])) }}")
                                                Dim response As WebResponse = request.GetResponse()

                                                Dim dataStream As Stream = response.GetResponseStream()
                                                Dim reader As New StreamReader(dataStream)

                                                Console.WriteLine("Response: " + reader.ReadToEnd().toString())
                                                response.Close()
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        @endif
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
<script src="{{ asset('dist/js/pages/dashboards/dashboard1.js') }}"></script>
<script src="{{ asset('assets/extra-libs/sparkline/sparkline.js') }}"></script>

<script src="{{ asset('assets/extra-libs/prism/prism.js') }}"></script>

<script src="{{ asset('assets/libs/footable/dist/footable.all.min.js') }}"></script>
<script src="{{ asset('dist/js/pages/footable/footable-init.js') }}"></script>

<script>
    function copyToClipboard(element) {
        var $temp = $("<input>");
        $("body").append($temp);
        $temp.val($(element).text()).select();
        document.execCommand("copy");
        $temp.remove();
    }
</script>
@endsection
