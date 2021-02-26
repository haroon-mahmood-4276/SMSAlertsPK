@extends('shared.layout')

@section('PageTitle', 'Login')


@section('content')
<div class="container mb-5 card">

    @if (Session::get('AlertType') && Session::get('AlertMsg'))
    <div class="alerts">
        <div class="alert alert-{{Session::get('AlertType')}} alert-dismissible fade show" role="alert">
            {{Session::get('AlertMsg')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
    </div>
    @endif


    <form action="{{route('r.login')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}">
            <span class="text-danger">@error('email') {{$message}} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password">
            <span class="text-danger">@error('password') {{$message}} @enderror</span>
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection