@extends('shared.layout')

@section('PageTitle', 'Quick SMS')

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
                    <h5 class="card-title activator">Quick SMS</h5>
                    <form action="{{route('r.quicksms')}}" class="formValidate" id="formValidate" method="POST">
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
                                <input id="phone_number" name="phone_number" type="text"
                                    class="@error('phone_number') error @enderror" value="{{old('phone_number')}}">
                                <label for="phone_number">Name *</label>
                                @error('phone_number')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>


                            <div class="input-field col s12 m12 l12">
                                <i class="material-icons prefix">question_answer</i>
                                <textarea id="message" name="message"
                                    class="materialize-textarea validate @error('message') error @enderror"
                                    value="{{old('message')}}"></textarea>
                                <label for="message">Message *</label>
                                @error('message')
                                <span style="color: red">{{$message}}</span>
                                @enderror
                            </div>

                            <div class="col s12 m12 l12">
                                <button class="btn waves-effect waves-light right submit" type="submit"
                                    name="action">Send SMS
                                </button>
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

@endsection