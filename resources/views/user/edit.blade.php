@extends('shared.layout')

@section('PageTitle', 'Edit User')


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

    <form action="{{route('users.update', ['user' => $User->id])}}" method="POST">
        @csrf
        @method('PATCH')
        <div class="mb-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="first_name" name="first_name" class="form-control" id="first_name"
                value="{{$User->first_name}}">
            <span class="text-danger">@error('first_name') {{$message}} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="last_name" name="last_name" class="form-control" id="last_name" value="{{$User->last_name}}">
            <span class="text-danger">@error('last_name') {{$message}} @enderror</span>
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" value="{{$User->email}}">
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