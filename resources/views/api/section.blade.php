@extends('shared.layout')

@section('PageTitle',
    Str::of($company_nature)->plural()->ucfirst() . ' API',)

@section('BeforeCommonCss')
    <link href="{{ asset('assets/extra-libs/prism/prism.css') }}" rel="stylesheet">
@endsection

@section('AfterCommonCss')
    <style>
        .collection {
            border-radius: 10px;
        }

    </style>
@endsection

@section('content')
    <div class="page-wrapper ">
        <div class="page-titles">
            <div class="d-flex align-items-center">
                <h5 class="font-medium m-b-0">{{ Str::of($company_nature)->plural()->ucfirst() }} API</h5>
                <div class="custom-breadcrumb ml-auto">
                    <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                    <a href="javascript:void(0)" class="breadcrumb">API Documentation</a>
                    <a href="javascript:void(0)" class="breadcrumb">{{ Str::of($company_nature)->plural()->ucfirst() }}
                        API</a>
                </div>
            </div>
        </div>
        <div class="container-fluid">
            <div class="row">
                <div class="col s12 m12 l3">
                    <div class="collection" id="top-menu">
                        <a href="#list-of-{{ Str::of($company_nature)->plural() }}" class="collection-item">List
                            of {{ Str::of($company_nature)->plural() }}
                        </a>
                        <a href="#data-of-{{ Str::of($company_nature) }}" class="collection-item">Data
                            of {{ Str::of($company_nature) }}
                        </a>
                        <a href="#create-new-{{ Str::of($company_nature) }}" class="collection-item">Create a new
                            {{ Str::of($company_nature) }}
                        </a>
                        <a href="#update-a-{{ Str::of($company_nature) }}" class="collection-item">Update a
                            {{ Str::of($company_nature) }}</a>
                        <a href="#delete-a-{{ Str::of($company_nature) }}" class="collection-item">Delete a
                            {{ Str::of($company_nature) }}</a>
                    </div>
                </div>
                <div class="col s12 m12 l9">
                    <div class="card">
                        <div class="card-content">
                            <h4 class="card-title" id="list-of-{{ Str::of($company_nature)->plural() }}">1. List of
                                {{ Str::of($company_nature)->plural() }}</h4>
                            <div>
                                <p>It is a GET Request API.</p>
                                <pre>
                                    <code class="language-markup">
                                        <span>{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.index', ['email' => session('Data.email'), 'password' => '*********'])) }}</span>
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
                                                WebRequest request = WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.index', ['email' => session('Data.email'), 'password' => '*********'])) }}");
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
                                                Dim request As WebRequest = WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.index', ['email' => session('Data.email'), 'password' => '*********'])) }}")
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

                            <h4 class="card-title m-t-40" id="data-of-{{ Str::of($company_nature) }}">2. Data of
                                {{ Str::of($company_nature) }}</h4>
                            <div>
                                <p>It is a GET Request API.</p>
                                <pre>
                                    <code class="language-markup">
                                        <span>{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.show', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001', 'email' => session('Data.email'), 'password' => '*********'])) }}</span>
                                    </code>
                                </pre>

                                <div>
                                    <br>
                                    <h5>Coding Examples</h5>
                                    <ul class="tabs tab-demo z-depth-1">
                                        <li class="tab">
                                            <a class="active" href="#2csdotnet">C# .NET</a>
                                        </li>
                                        <li class="tab">
                                            <a class="" href="#2vbdotnet">VB .NET</a>
                                        </li>
                                    </ul>
                                    <div id="2csdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                WebRequest request = WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.show', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001', 'email' => session('Data.email'), 'password' => '*********'])) }}");
                                                WebResponse response = request.GetResponse();

                                                Stream dataStream = response.GetResponseStream();
                                                StreamReader reader = new StreamReader(dataStream);

                                                Console.WriteLine("Response: " + reader.ReadToEnd().toString());
                                                response.Close();
                                            </code>
                                        </pre>
                                    </div>
                                    <div id="2vbdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                Dim request As WebRequest = WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.show', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001', 'email' => session('Data.email'), 'password' => '*********'])) }}")
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

                            <h4 class="card-title m-t-40" id="create-new-{{ Str::of($company_nature) }}">3. Create a new
                                {{ Str::of($company_nature) }}</h4>
                            <div>
                                <p>It is POST Request.</p>
                                <div class="row">
                                    <div class="col s12 m12 l6">
                                        <pre>
                                            <code class="language-markup">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.store')) }}
                                                <br>
                                                form-data:[
                                                    'email': '{{ session('Data.email') }}',
                                                    'password': '*********'],
                                                    'code': '00001'
                                                    'name': 'Something'
                                                    '_method': 'POST'
                                                ]
                                            </code>
                                        </pre>
                                    </div>
                                    <div class="col s12 m12 l6">
                                        <pre>
                                            <code class="language-markup">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.store')) }}
                                                <br>
                                                x-www-form-urlencoded:[
                                                    'email': '{{ session('Data.email') }}',
                                                    'password': '*********'],
                                                    'code': '00001'
                                                    'name': 'Something'
                                                    '_method': 'POST'
                                                ]
                                            </code>
                                        </pre>
                                    </div>
                                </div>

                                <div>
                                    <br>
                                    <h5>Coding Examples</h5>
                                    <ul class="tabs tab-demo z-depth-1">
                                        <li class="tab">
                                            <a class="active" href="#3csdotnet">C# .NET</a>
                                        </li>
                                        <li class="tab">
                                            <a class="" href="#3vbdotnet">VB .NET</a>
                                        </li>
                                    </ul>
                                    <div id="3csdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                HttpWebRequest request = (HttpWebRequest)WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.store')) }}");
                                                request.Method = "POST";

                                                string postData = "email=business@smsalertspk.com&password=*********&code=00001&name=Something";
                                                byte[] byteArray = Encoding.UTF8.GetBytes(postData);

                                                request.ContentType = "application/x-www-form-urlencoded";
                                                request.ContentLength = byteArray.Length;

                                                Stream dataStream = request.GetRequestStream();
                                                dataStream.Write(byteArray, 0, byteArray.Length);
                                                dataStream.Close();

                                                HttpWebResponse response = (HttpWebResponse)request.GetResponse();
                                                dataStream = response.GetResponseStream();

                                                StreamReader reader = new StreamReader(dataStream);
                                                string responseFromServer = reader.ReadToEnd();
                                                Console.WriteLine("Response: " + responseFromServer.ToString());

                                                response.Close();
                                            </code>
                                        </pre>
                                    </div>
                                    <div id="3vbdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                Dim request As HttpWebRequest = CType(WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.store')) }}"), HttpWebRequest)
                                                request.Method = "POST"

                                                Dim postData As String = "email=business@smsalertspk.com&password=*********&code=00001&name=Something"
                                                Dim byteArray() As Byte = Encoding.UTF8.GetBytes(postData)

                                                request.ContentType = "application/x-www-form-urlencoded"
                                                request.ContentLength = byteArray.Length

                                                Dim dataStream As Stream = request.GetRequestStream()
                                                dataStream.Write(byteArray, 0, byteArray.Length)
                                                dataStream.Close()

                                                Dim response As HttpWebResponse = CType(request.GetResponse(), HttpWebResponse)
                                                dataStream = response.GetResponseStream()

                                                Dim reader As StreamReader = New StreamReader(dataStream)
                                                Dim responseFromServer As String = reader.ReadToEnd()
                                                Console.WriteLine("Response: " + responseFromServer.ToString())

                                                response.Close()
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title m-t-40" id="update-a-{{ Str::of($company_nature) }}">4. Update a
                                {{ Str::of($company_nature) }}</h4>
                            <div>
                                <p>It is PUT Request.</p>
                                <div class="row">
                                    <div class="col s12 m12 l6">
                                        <pre>
                                            <code class="language-markup">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.update', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}
                                                <br>
                                                form-data:[
                                                    'email': '{{ session('Data.email') }}',
                                                    'password': '*********'],
                                                    'name': 'Something'
                                                    '_method': 'PUT'
                                                ]
                                            </code>
                                        </pre>
                                    </div>
                                    <div class="col s12 m12 l6">
                                        <pre>
                                            <code class="language-markup">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.update', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}
                                                <br>
                                                x-www-form-urlencoded:[
                                                    'email': '{{ session('Data.email') }}',
                                                    'password': '*********'],
                                                    'name': 'Something'
                                                    '_method': 'PUT'
                                                ]
                                            </code>
                                        </pre>
                                    </div>
                                </div>

                                <div>
                                    <br>
                                    <h5>Coding Examples</h5>
                                    <ul class="tabs tab-demo z-depth-1">
                                        <li class="tab">
                                            <a class="active" href="#4csdotnet">C# .NET</a>
                                        </li>
                                        <li class="tab">
                                            <a class="" href="#4vbdotnet">VB .NET</a>
                                        </li>
                                    </ul>
                                    <div id="4csdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                HttpWebRequest request = (HttpWebRequest)WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.update', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}");
                                                request.Method = "PUT";

                                                string putData = "email=business@smsalertspk.com&password=*********&name=Something";
                                                byte[] byteArray = Encoding.UTF8.GetBytes(postData);

                                                request.ContentType = "application/x-www-form-urlencoded";
                                                request.ContentLength = byteArray.Length;

                                                Stream dataStream = request.GetRequestStream();
                                                dataStream.Write(byteArray, 0, byteArray.Length);
                                                dataStream.Close();

                                                HttpWebResponse response = (HttpWebResponse)request.GetResponse();
                                                dataStream = response.GetResponseStream();

                                                StreamReader reader = new StreamReader(dataStream);
                                                string responseFromServer = reader.ReadToEnd();
                                                Console.WriteLine("Response: " + responseFromServer.ToString());

                                                response.Close();
                                            </code>
                                        </pre>
                                    </div>
                                    <div id="4vbdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                Dim request As HttpWebRequest = CType(WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.update', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}"), HttpWebRequest)
                                                request.Method = "PUT"

                                                Dim putData As String = "email=business@smsalertspk.com&password=*********&name=Something"
                                                Dim byteArray() As Byte = Encoding.UTF8.GetBytes(postData)

                                                request.ContentType = "application/x-www-form-urlencoded"
                                                request.ContentLength = byteArray.Length

                                                Dim dataStream As Stream = request.GetRequestStream()
                                                dataStream.Write(byteArray, 0, byteArray.Length)
                                                dataStream.Close()

                                                Dim response As HttpWebResponse = CType(request.GetResponse(), HttpWebResponse)
                                                dataStream = response.GetResponseStream()

                                                Dim reader As StreamReader = New StreamReader(dataStream)
                                                Dim responseFromServer As String = reader.ReadToEnd()
                                                Console.WriteLine("Response: " + responseFromServer.ToString())

                                                response.Close()
                                            </code>
                                        </pre>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title m-t-40" id="delete-a-{{ Str::of($company_nature) }}">5. Delete a
                                {{ Str::of($company_nature) }}</h4>
                            <div>
                                <p>It is DELETE Request.</p>
                                <div class="row">
                                    <div class="col s12 m12 l6">
                                        <pre>
                                            <code class="language-markup">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.destroy', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}
                                                <br>
                                                form-data:[
                                                    'email': '{{ session('Data.email') }}',
                                                    'password': '*********'],
                                                    '_method': 'DELETE'
                                                ]
                                            </code>
                                        </pre>
                                    </div>
                                    <div class="col s12 m12 l6">
                                        <pre>
                                            <code class="language-markup">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.destroy', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}
                                                <br>
                                                x-www-form-urlencoded:[
                                                    'email': '{{ session('Data.email') }}',
                                                    'password': '*********'],
                                                    '_method': 'DELETE'
                                                ]
                                            </code>
                                        </pre>
                                    </div>
                                </div>

                                <div>
                                    <br>
                                    <h5>Coding Examples</h5>
                                    <ul class="tabs tab-demo z-depth-1">
                                        <li class="tab">
                                            <a class="active" href="#5csdotnet">C# .NET</a>
                                        </li>
                                        <li class="tab">
                                            <a class="" href="#5vbdotnet">VB .NET</a>
                                        </li>
                                    </ul>
                                    <div id="5csdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                HttpWebRequest request = (HttpWebRequest)WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.destroy', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}");
                                                request.Method = "DELETE";

                                                string deleteData = "email=business@smsalertspk.com&password=*********";
                                                byte[] byteArray = Encoding.UTF8.GetBytes(postData);

                                                request.ContentType = "application/x-www-form-urlencoded";
                                                request.ContentLength = byteArray.Length;

                                                Stream dataStream = request.GetRequestStream();
                                                dataStream.Write(byteArray, 0, byteArray.Length);
                                                dataStream.Close();

                                                HttpWebResponse response = (HttpWebResponse)request.GetResponse();
                                                dataStream = response.GetResponseStream();

                                                StreamReader reader = new StreamReader(dataStream);
                                                string responseFromServer = reader.ReadToEnd();
                                                Console.WriteLine("Response: " + responseFromServer.ToString());

                                                response.Close();
                                            </code>
                                        </pre>
                                    </div>
                                    <div id="5vbdotnet">
                                        <pre>
                                            <code class="language-markup">
                                                Dim request As HttpWebRequest = CType(WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.destroy', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}"), HttpWebRequest)
                                                request.Method = "DELETE"

                                                Dim deleteData As String = "email=business@smsalertspk.com&password=*********"
                                                Dim byteArray() As Byte = Encoding.UTF8.GetBytes(postData)

                                                request.ContentType = "application/x-www-form-urlencoded"
                                                request.ContentLength = byteArray.Length

                                                Dim dataStream As Stream = request.GetRequestStream()
                                                dataStream.Write(byteArray, 0, byteArray.Length)
                                                dataStream.Close()

                                                Dim response As HttpWebResponse = CType(request.GetResponse(), HttpWebResponse)
                                                dataStream = response.GetResponseStream()

                                                Dim reader As StreamReader = New StreamReader(dataStream)
                                                Dim responseFromServer As String = reader.ReadToEnd()
                                                Console.WriteLine("Response: " + responseFromServer.ToString())

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
    <script src="{{ asset('assets/extra-libs/prism/prism.js') }}"></script>
@endsection
