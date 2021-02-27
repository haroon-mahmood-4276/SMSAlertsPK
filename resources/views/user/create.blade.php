@extends('shared.layout')

@section('PageTitle', 'Create User')


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


    <form action="{{route('users.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="first_name" class="form-label">First name</label>
            <input type="text" name="first_name" class="form-control" id="first_name" value="{{old('first_name')}}">
            @error('first_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last name</label>
            <input type="text" name="last_name" class="form-control" id="last_name" value="{{old('last_name')}}">
            @error('last_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">Email address</label>
            <input type="email" name="email" class="form-control" id="email" value="{{old('email')}}"
                placeholder="abc@example.com">
            @error('email')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="password" class="form-label">Password</label>
            <input type="password" name="password" class="form-control" id="password" placeholder="Leave blank to use previous password">
            @error('password')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company_name" class="form-label">Company Name</label>
            <input type="text" name="company_name" class="form-control" id="company_name"
                value="{{old('company_name')}}" placeholder="abc@example.com">
            @error('company_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company_mask_id" class="form-label">Company Mask Id</label>
            <input type="text" name="company_mask_id" class="form-control" id="company_mask_id"
                value="{{old('company_mask_id')}}" placeholder="Company Mask ID">
            @error('company_mask_id')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company_nature" class="form-label">Company Nature</label>
            <select class="form-select" name="company_nature" id="company_nature">
                <option value="" selected>Open this select menu</option>
                <option value="B">Business</option>
                <option value="S">School</option>
            </select>
            @error('company_nature')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="company_email" class="form-label">Company Email</label>
            <input type="text" name="company_email" class="form-control" id="company_email"
                value="{{old('company_email')}}" placeholder="abc@example.com">
            @error('company_email')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="mobile_1" class="form-label">Mobile 1</label>
            <input type="text" name="mobile_1" class="form-control" id="mobile_1" value="{{old('mobile_1')}}"
                placeholder="923001234567">
            @error('mobile_1')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="mobile_2" class="form-label">Mobile 2</label>
            <input type="number" name="mobile_2" class="form-control" id="mobile_2" value="{{old('mobile_2')}}"
                placeholder="923001234567">
            @error('mobile_2')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="no_of_sms" class="form-label">Number of sms</label>
            <input type="number" name="no_of_sms" class="form-control" id="no_of_sms" value="{{old('no_of_sms')}}">
            @error('no_of_sms')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection