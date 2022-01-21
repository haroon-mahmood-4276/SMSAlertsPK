@extends('shared.layout')

@section('PageTitle',
    Str::of($company_nature)->plural()->ucfirst() . ' API',)

@section('CSS')
    <style>
        .collection {
            border-radius: 10px;
        }

        .codingStyle {
            border: 1px solid lightgray !important;
            padding: 15px;
            width: 100%;
            margin-top: 15px;
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

                                <div class="codingStyle">
                                    <code class="">
                                        <span>{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.index', ['email' => session('Data.email'), 'password' => '*********'])) }}</span>
                                    </code>
                                </div>
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
                                        <div class="codingStyle">
                                            <code>
                                                WebRequest request =
                                                WebRequest.Create("http://localhost:8000/api/groups?email=business@smsalertspk.com&password=*********");
                                                <br>
                                                WebResponse response = request.GetResponse(); <br>
                                                Stream dataStream = response.GetResponseStream(); <br>
                                                StreamReader reader = new StreamReader(dataStream); <br>
                                                Console.WriteLine("Response: " + reader.ReadToEnd().toString()); <br>
                                                response.Close(); <br>
                                            </code>
                                        </div>
                                    </div>
                                    <div id="1vbdotnet">
                                        <div class="codingStyle">
                                            <code>
                                                Dim request As WebRequest =
                                                WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.index', ['email' => session('Data.email'), 'password' => '*********'])) }}")
                                                <br>
                                                Dim response As WebResponse = request.GetResponse()<br>
                                                Dim dataStream As Stream = response.GetResponseStream()<br>
                                                Dim reader As New StreamReader(dataStream)<br>
                                                Console.WriteLine("Response: " + reader.ReadToEnd().toString())<br>
                                                response.Close()<br>
                                            </code>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title m-t-40" id="data-of-{{ Str::of($company_nature) }}">2. Data of
                                {{ Str::of($company_nature) }}</h4>
                            <div>
                                <p>It is a GET Request API.</p>
                                <div class="codingStyle">
                                    <code>
                                        <span>{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.show', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001', 'email' => session('Data.email'), 'password' => '*********'])) }}</span>
                                    </code>
                                </div>

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
                                        <div class="codingStyle">
                                            <code class="">
                                                WebRequest request =
                                                WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.show', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001', 'email' => session('Data.email'), 'password' => '*********'])) }}");
                                                <br>
                                                WebResponse response = request.GetResponse(); <br>
                                                Stream dataStream = response.GetResponseStream(); <br>
                                                StreamReader reader = new StreamReader(dataStream); <br>
                                                Console.WriteLine("Response: " + reader.ReadToEnd().toString()); <br>
                                                response.Close(); <br>
                                            </code>
                                        </div>
                                    </div>
                                    <div id="2vbdotnet">
                                        <div class="codingStyle">
                                            <code class="">
                                                Dim request As WebRequest =
                                                WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.show', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001', 'email' => session('Data.email'), 'password' => '*********'])) }}")
                                                <br>
                                                Dim response As WebResponse = request.GetResponse() <br>
                                                Dim dataStream As Stream = response.GetResponseStream() <br>
                                                Dim reader As New StreamReader(dataStream) <br>
                                                Console.WriteLine("Response: " + reader.ReadToEnd().toString()) <br>
                                                response.Close() <br>
                                            </code>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title m-t-40" id="create-new-{{ Str::of($company_nature) }}">3. Create a new
                                {{ Str::of($company_nature) }}</h4>
                            <div>
                                <p>It is POST Request.</p>
                                <div class="row">
                                    <div class="col s12 m12 l6">
                                        <div class="codingStyle">
                                            <code class="">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.store')) }}
                                                <br>
                                                form-data: [ <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'email': '{{ session('Data.email') }}', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'password': '*********', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'code': '00001' <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'name': 'Something' <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'_method': 'POST', <br>
                                                ]
                                            </code>
                                        </div>
                                    </div>
                                    <div class="col s12 m12 l6">
                                        <div class="codingStyle">
                                            <code class="">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.store')) }}
                                                <br>
                                                x-www-form-urlencoded: [ <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'email': '{{ session('Data.email') }}', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'password': '*********', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'code': '00001' <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'name': 'Something' <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'_method': 'POST', <br>
                                                ]
                                            </code>
                                        </div>
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
                                        <div class="codingStyle">
                                            <code class="">
                                                HttpWebRequest request =
                                                (HttpWebRequest)WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.store')) }}");
                                                <br>
                                                request.Method = "POST"; <br><br>
                                                string postData =
                                                "email=business@smsalertspk.com&password=*********&code=00001&name=Something";
                                                <br>
                                                byte[] byteArray = Encoding.UTF8.GetBytes(postData); <br><br>
                                                request.ContentType = "application/x-www-form-urlencoded"; <br>
                                                request.ContentLength = byteArray.Length; <br>
                                                Stream dataStream = request.GetRequestStream(); <br><br>
                                                dataStream.Write(byteArray, 0, byteArray.Length); <br>
                                                dataStream.Close(); <br>
                                                HttpWebResponse response = (HttpWebResponse)request.GetResponse(); <br>
                                                dataStream = response.GetResponseStream(); <br><br>
                                                StreamReader reader = new StreamReader(dataStream); <br>
                                                string responseFromServer = reader.ReadToEnd(); <br>
                                                Console.WriteLine("Response: " + responseFromServer.ToString()); <br><br>
                                                response.Close(); <br>
                                            </code>
                                        </div>
                                    </div>
                                    <div id="3vbdotnet">
                                        <div class="codingStyle">
                                            <code class="">
                                                Dim request As HttpWebRequest =
                                                CType(WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.store')) }}"),
                                                HttpWebRequest) <br>
                                                request.Method = "POST" <br><br>

                                                Dim postData As String =
                                                "email=business@smsalertspk.com&password=*********&code=00001&name=Something"
                                                <br>
                                                Dim byteArray() As Byte = Encoding.UTF8.GetBytes(postData) <br><br>

                                                request.ContentType = "application/x-www-form-urlencoded" <br>
                                                request.ContentLength = byteArray.Length <br><br>

                                                Dim dataStream As Stream = request.GetRequestStream() <br>
                                                dataStream.Write(byteArray, 0, byteArray.Length) <br><br>
                                                dataStream.Close() <br>

                                                Dim response As HttpWebResponse = CType(request.GetResponse(),
                                                HttpWebResponse) <br>
                                                dataStream = response.GetResponseStream() <br><br>

                                                Dim reader As StreamReader = New StreamReader(dataStream) <br>
                                                Dim responseFromServer As String = reader.ReadToEnd() <br>
                                                Console.WriteLine("Response: " + responseFromServer.ToString()) <br><br>

                                                response.Close() <br>
                                            </code>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title m-t-40" id="update-a-{{ Str::of($company_nature) }}">4. Update a
                                {{ Str::of($company_nature) }}</h4>
                            <div>
                                <p>It is PUT Request.</p>
                                <div class="row">
                                    <div class="col s12 m12 l6">
                                        <div class="codingStyle">
                                            <code class="">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.update', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}
                                                <br>
                                                form-data: [ <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'email': '{{ session('Data.email') }}', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'password': '*********', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'name': 'Something' <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'_method': 'PUT', <br>
                                                ]
                                            </code>
                                        </div>
                                    </div>
                                    <div class="col s12 m12 l6">
                                        <div class="codingStyle">
                                            <code class="">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.update', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}<br>
                                                x-www-form-urlencoded: [ <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'email': '{{ session('Data.email') }}', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'password': '*********', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'name': 'Something' <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'_method': 'PUT', <br>
                                                ]
                                            </code>
                                        </div>
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
                                        <div class="codingStyle">
                                            <code class="">
                                                HttpWebRequest request =
                                                (HttpWebRequest)WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.update', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}");
                                                <br>
                                                request.Method = "PUT"; <br>
                                                <br>
                                                string putData =
                                                "email=business@smsalertspk.com&password=*********&name=Something"; <br>
                                                byte[] byteArray = Encoding.UTF8.GetBytes(postData); <br>
                                                <br>
                                                request.ContentType = "application/x-www-form-urlencoded"; <br>
                                                request.ContentLength = byteArray.Length; <br>
                                                <br>
                                                Stream dataStream = request.GetRequestStream(); <br>
                                                dataStream.Write(byteArray, 0, byteArray.Length); <br>
                                                dataStream.Close(); <br>
                                                <br>
                                                HttpWebResponse response = (HttpWebResponse)request.GetResponse(); <br>
                                                dataStream = response.GetResponseStream(); <br>
                                                <br>
                                                StreamReader reader = new StreamReader(dataStream); <br>
                                                string responseFromServer = reader.ReadToEnd(); <br>
                                                Console.WriteLine("Response: " + responseFromServer.ToString()); <br>
                                                <br>
                                                response.Close(); <br>
                                            </code>
                                        </div>
                                    </div>
                                    <div id="4vbdotnet">
                                        <div class="codingStyle">
                                            <code class="">
                                                Dim request As HttpWebRequest =
                                                CType(WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.update', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}"),
                                                HttpWebRequest) <br>
                                                request.Method = "PUT" <br>
                                                <br>
                                                Dim putData As String =
                                                "email=business@smsalertspk.com&password=*********&name=Something" <br>
                                                Dim byteArray() As Byte = Encoding.UTF8.GetBytes(postData) <br>
                                                <br>
                                                request.ContentType = "application/x-www-form-urlencoded" <br>
                                                request.ContentLength = byteArray.Length <br>
                                                <br>
                                                Dim dataStream As Stream = request.GetRequestStream() <br>
                                                dataStream.Write(byteArray, 0, byteArray.Length) <br>
                                                dataStream.Close() <br>
                                                <br>
                                                Dim response As HttpWebResponse = CType(request.GetResponse(),
                                                HttpWebResponse) <br>
                                                dataStream = response.GetResponseStream() <br>
                                                <br>
                                                Dim reader As StreamReader = New StreamReader(dataStream) <br>
                                                Dim responseFromServer As String = reader.ReadToEnd() <br>
                                                Console.WriteLine("Response: " + responseFromServer.ToString()) <br>
                                                <br>
                                                response.Close() <br>
                                            </code>
                                        </div>
                                    </div>
                                </div>
                            </div>

                            <h4 class="card-title m-t-40" id="delete-a-{{ Str::of($company_nature) }}">5. Delete a
                                {{ Str::of($company_nature) }}</h4>
                            <div>
                                <p>It is DELETE Request.</p>
                                <div class="row">
                                    <div class="col s12 m12 l6">
                                        <div class="codingStyle">
                                            <code class="">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.destroy', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}
                                                <br>
                                                form-data: [ <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'email': '{{ session('Data.email') }}', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'password': '*********', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'_method': 'DELETE', <br>
                                                ]
                                            </code>
                                        </div>
                                    </div>
                                    <div class="col s12 m12 l6">
                                        <div class="codingStyle">
                                            <code class="">
                                                {{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.destroy', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}
                                                <br>
                                                x-www-form-urlencoded: [ <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'email': '{{ session('Data.email') }}', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'password': '*********', <br>
                                                &nbsp;&nbsp;&nbsp;&nbsp;'_method': 'DELETE', <br>
                                                ]
                                            </code>
                                        </div>
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
                                        <div class="codingStyle">
                                            <code class="">
                                                HttpWebRequest request =
                                                (HttpWebRequest)WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.destroy', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}");
                                                <br>
                                                request.Method = "DELETE"; <br>
                                                <br>
                                                string deleteData = "email=business@smsalertspk.com&password=*********";
                                                <br>
                                                byte[] byteArray = Encoding.UTF8.GetBytes(postData); <br>
                                                <br>
                                                request.ContentType = "application/x-www-form-urlencoded"; <br>
                                                request.ContentLength = byteArray.Length; <br>
                                                <br>
                                                Stream dataStream = request.GetRequestStream(); <br>
                                                dataStream.Write(byteArray, 0, byteArray.Length); <br>
                                                dataStream.Close(); <br>
                                                <br>
                                                HttpWebResponse response = (HttpWebResponse)request.GetResponse(); <br>
                                                dataStream = response.GetResponseStream(); <br>
                                                <br>
                                                StreamReader reader = new StreamReader(dataStream); <br>
                                                string responseFromServer = reader.ReadToEnd(); <br>
                                                Console.WriteLine("Response: " + responseFromServer.ToString()); <br>
                                                <br>
                                                response.Close(); <br>
                                            </code>
                                        </div>
                                    </div>
                                    <div id="5vbdotnet">
                                        <div class="codingStyle">
                                            <code class="">
                                                Dim request As HttpWebRequest =
                                                CType(WebRequest.Create("{{ urldecode(route('api.' . Str::of($company_nature)->plural() . '.destroy', [Session::get('Data.company_nature') == 'B' ? 'group' : 'class' => '00001'])) }}"),
                                                HttpWebRequest) <br>
                                                request.Method = "DELETE" <br>
                                                <br>
                                                Dim deleteData As String =
                                                "email=business@smsalertspk.com&password=*********" <br>
                                                Dim byteArray() As Byte = Encoding.UTF8.GetBytes(postData) <br>
                                                <br>
                                                request.ContentType = "application/x-www-form-urlencoded" <br>
                                                request.ContentLength = byteArray.Length <br>
                                                <br>
                                                Dim dataStream As Stream = request.GetRequestStream() <br>
                                                dataStream.Write(byteArray, 0, byteArray.Length) <br>
                                                dataStream.Close() <br>
                                                <br>
                                                Dim response As HttpWebResponse = CType(request.GetResponse(), <br>
                                                HttpWebResponse) <br>
                                                dataStream = response.GetResponseStream() <br>
                                                <br>
                                                Dim reader As StreamReader = New StreamReader(dataStream) <br>
                                                Dim responseFromServer As String = reader.ReadToEnd() <br>
                                                Console.WriteLine("Response: " + responseFromServer.ToString()) <br>
                                                <br>
                                                response.Close() <br>
                                            </code>
                                        </div>
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

@endsection
