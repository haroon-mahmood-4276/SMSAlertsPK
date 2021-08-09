@extends('shared.layout')

@section('PageTitle', (Str::of($company_nature)->plural()->ucfirst()) . ' API')

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
            <h5 class="font-medium m-b-0">{{Str::of($company_nature)->plural()->ucfirst()}} API</h5>
            <div class="custom-breadcrumb ml-auto">
                <a href="{{ route('r.dashboard') }}" class="breadcrumb">Dashboard</a>
                <a href="javascript:void(0)" class="breadcrumb">API Documentation</a>
                <a href="javascript:void(0)"
                    class="breadcrumb">{{Str::of($company_nature)->plural()->ucfirst()}} API</a>
            </div>
        </div>
    </div>
    <div class="container-fluid">
        <div class="row">
            <div class="col s12 m12 l3">
                <div>
                    <div class="collection" id="top-menu">

                        <a href="#list-of-{{ Str::of($company_nature)->plural() }}"
                            class="collection-item active">List of
                            {{ Str::of($company_nature)->plural() }}
                        </a>
                        <a href="#create-new-{{ Str::of($company_nature) }}"
                            class="collection-item">Create a new
                            {{ Str::of($company_nature) }}
                        </a>
                        <a href="#3" class="collection-item">Title will be 3</a>
                        <a href="#4" class="collection-item">Title will be 4</a>
                        <a href="#5" class="collection-item">Title will be 5</a>
                        <a href="#6" class="collection-item">Title will be 6</a>
                        <a href="#7" class="collection-item">Title will be 7</a>
                        <a href="#8" class="collection-item">Title will be 8</a>
                        <a href="#9" class="collection-item">Title will be 9</a>
                        <a href="#10" class="collection-item">Title will be 10</a>
                    </div>
                </div>
            </div>
            <div class="col s12 m12 l9">
                <div class="card">
                    <div class="card-content">
                        <h4 class="card-title"
                            id="list-of-{{ Str::of($company_nature)->plural() }}">1. List of
                            {{ Str::of($company_nature)->plural() }}</h4>
                        <div>
                            <p>It is a GET Request API.</p>
                            <pre>
                                <code class="language-markup">
                                   <span>{{ urldecode(route('api.' . (Str::of($company_nature)->plural()) . '.index', ['email' => session('Data.email'), 'password' => '*********'])) }}</span>
                                </code>
                            </pre>

                            <div>
                                <br>
                                <h5>Coding Examples</h5>
                                <ul class="tabs tab-demo z-depth-1">
                                    <li class="tab">
                                        <a class="active" href="#csdotnet">C# .NET</a>
                                    </li>
                                    <li class="tab">
                                        <a class="active" href="#vbdotnet">VB .NET</a>
                                    </li>
                                </ul>
                                <div id="csdotnet">
                                    <pre>
                                        <code class="language-markup">
                                            WebRequest request = WebRequest.Create("{{ urldecode(route('api.' . (Str::of($company_nature)->plural()) . '.index', ['email' => session('Data.email'), 'password' => '*********'])) }}");
                                            WebResponse response = request.GetResponse();

                                            Stream dataStream = response.GetResponseStream();
                                            StreamReader reader = new StreamReader(dataStream);

                                            Console.WriteLine("Response: " + reader.ReadToEnd().toString());
                                            response.Close();
                                        </code>
                                    </pre>
                                </div>
                                <div id="vbdotnet">
                                    <pre>
                                        <code class="language-markup">
                                            Dim request As WebRequest = WebRequest.Create("{{ urldecode(route('api.' . (Str::of($company_nature)->plural()) . '.index', ['email' => session('Data.email'), 'password' => '*********'])) }}")
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

                        <h4 class="card-title m-t-40"
                            id="create-new-{{ Str::of($company_nature) }}">2. Create a
                            new {{ Str::of($company_nature) }}</h4>
                        <div>
                            <p>It is POST Request.</p>
                            <pre>
                                <code class="language-markup">
                                    {{ urldecode(route('api.' . (Str::of($company_nature)->plural()) . '.store')) }}</span>
                                </code>
                            </pre>
                            <div class="row">
                                <div class="col s12 m12 l6">
                                    <pre>
                                        <code class="language-markup">
                                            {{ urldecode(route('api.' . (Str::of($company_nature)->plural()) . '.store')) }}
                                            <br>
                                            form-body:[
                                                'email': '{{ session('Data.email') }}',
                                                'password': '*********'],
                                                'name': 'Something'
                                                '_method': 'POST'
                                            ]
                                        </code>
                                    </pre>
                                </div>
                                <div class="col s12 m12 l6">
                                    <pre>
                                        <code class="language-markup">
                                            {{ urldecode(route('api.' . (Str::of($company_nature)->plural()) . '.store')) }}
                                            <br>
                                            x-www-form-urlencoded:[
                                                'email': '{{ session('Data.email') }}',
                                                'password': '*********'],
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
                                    <li class="tab"><a class="active" href="#vbdotnet">VB .NET</a>
                                    </li>
                                </ul>
                                <div id="vbdotnet">
                                    <pre>
                                        <code class="language-markup">
                                            {{ urldecode(route('api.' . (Str::of($company_nature)->plural()) . '.store')) }}
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
                        </div>

                        <h4 class="card-title m-t-40" id="3">3. Title will be here</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla
                            consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                            pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <h4 class="card-title m-t-40" id="4">4. Title will be here</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla
                            consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                            pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <h4 class="card-title m-t-40" id="5">5. Title will be here</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla
                            consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                            pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <h4 class="card-title m-t-40" id="6">6. Title will be here</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla
                            consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                            pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <h4 class="card-title m-t-40" id="7">7. Title will be here</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla
                            consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                            pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <h4 class="card-title m-t-40" id="8">8. Title will be here</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla
                            consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                            pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <h4 class="card-title m-t-40" id="9">9. Title will be here</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla
                            consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                            pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <h4 class="card-title m-t-40" id="10">10. Title will be here</h4>
                        <p>Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor.
                            Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur
                            ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem.Nulla
                            consequat massa quis enim. Donec pede justo, fringilla vel, aliquet nec, vulputate eget,
                            arcu. In enim justo, rhoncus ut, imperdiet a, venenatis vitae, justo. Nullam dictum felis eu
                            pede mollis pretium. Integer tincidunt. Cras dapibus. Vivamus elementum semper nisi.</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
                        <p> enean leo ligula, porttitor eu, consequat vitae, eleifend ac, enim. Aliquam lorem ante,
                            dapibus in, viverra quis, feugiat a, tellus. Phasellus viverra nulla ut metus varius
                            laoreet. Quisque rutrum. Aenean imperdiet. Etiam ultricies nisi vel augue. Curabitur
                            ullamcorper ultricies nisi. Nam eget dui. Etiam rhoncus. Maecenas tempus, tellus eget
                            condimentum rhoncus, sem quam semper libero, sit amet adipiscing sem neque sed ipsum. Nam
                            quam nunc, blandit vel, luctus pulvinar,</p>
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
