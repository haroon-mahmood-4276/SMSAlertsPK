@extends('shared.layout')

@section('PageTitle', 'Create Template')

@section('BeforeCommonCss')

@endsection

@section('AfterCommonCss')
@endsection

@section('content')
<div class="page-wrapper">
    <div class="row">
        <div class="col l12 m12 s12">
            <div class="card">
                <div class="card-content">
                    <h5 class="card-title activator">Create Template</h5>
                    <form action="{{route('sections.store')}}" class="formValidate" id="formValidate" method="POST">
                        @csrf
                        @if (Session::get("AlertType") && Session::get("AlertMsg"))
                        <div class="row">
                            <div class="col l12 m12 s12 m-5">
                                <div class="{{Session::get("AlertType")}}-alert-bar p-15 m-b-20 white-text">
                                    {{Session::get("AlertMsg")}}
                                </div>
                            </div>
                        </div>
                        @endif
                        <div class="row">
                            <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">text_format</i>
                                <input id="name" name="name" type="text" class="@error('name') error @enderror"
                                    value="{{old('name')}}">
                                <label for="name">Name *</label>
                                @error('name')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col s12 m12 l12">
                                <p><strong>Tags</strong></p>
                                <div class="row">
                                    <div class="col s1 m2 l2">
                                        <a href="javascript:void(0)" id="first_name" onmouseup="textbox(this.id)"
                                            class="chip">First Name</a>
                                    </div>
                                    <div class="col s1 m2 l2">
                                        <a href="javascript:void(0)" id="last_name" onmouseup="textbox(this.id)"
                                            class="chip">Last Name</a>
                                    </div>
                                    <div class="col s1 m2 l2">
                                        <a href="javascript:void(0)" id="3" onmouseup="textbox(this.id)"
                                            class="chip">Jane
                                            Doe</a>
                                    </div>
                                    <div class="col s1 m2 l2">
                                        <a href="javascript:void(0)" id="4" onmouseup="textbox(this.id)"
                                            class="chip">Jane
                                            Doe</a>
                                    </div>
                                    <div class="col s1 m2 l2">
                                        <a href="javascript:void(0)" id="5" onmouseup="textbox(this.id)"
                                            class="chip">Jane
                                            Doe</a>
                                    </div>
                                    <div class="col s1 m2 l2">
                                        <a href="javascript:void(0)" id="6" onmouseup="textbox(this.id)"
                                            class="chip">Jane
                                            Doe</a>
                                    </div>
                                </div>
                            </div>

                            <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">question_answer</i>
                                <textarea id="template" name="template"
                                    class="materialize-textarea validate @error('template') error @enderror"
                                    value="{{old('template')}}"></textarea>
                                <label for="template">Message *</label>
                                @error('template')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col s12 m12 l12">
                                <button class="btn waves-effect waves-light right submit" type="submit"
                                    name="action">Submit
                                </button>
                                <a href="{{ route('sections.index') }}"
                                    class="btn waves-effect red waves-light right m-r-10">Back to Template
                                    List</a>
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
<script src="{{asset('assets/libs/jquery/dist/jquery.min.js')}}"></script>
<script src="{{asset('dist/js/materialize.min.js')}}"></script>
<script src="{{asset('assets/libs/perfect-scrollbar/dist/js/perfect-scrollbar.jquery.min.js')}}"></script>
<script src="{{asset('dist/js/app.js')}}"></script>
<script src="{{asset('dist/js/app.init.js')}}"></script>
<script src="{{asset('dist/js/app-style-switcher.js')}}"></script>
<script src="{{asset('dist/js/custom.min.js')}}"></script>

<script type="text/javascript">
    function textbox(Element)
    {
        var ctl = document.getElementById('template');
        var EndPosition = ctl.selectionEnd;
        ctl.value = [ctl.value.slice(0, EndPosition), "[" + Element +"]", ctl.value.slice(EndPosition, ctl.value.length )].join('');
    }
</script>
@endsection