@extends('shared.layout')

@section('PageTitle', 'Create Group')


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


    <form action="{{route('groups.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="company_name" class="form-label">Company</label>
            <select class="form-select" name="company_name" id="company_name">
                <option value="" >Select</option>
                @foreach ($Companies as $Company)
                <option value="{{$Company->id}}" {{ ($Company->id == old('company_name') ? 'selected':'') }}>{{$Company->company_name}}</option>    
                @endforeach
            </select>
            @error('company_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="name" class="form-label">Group Name</label>
            <input type="text" name="name" class="form-control @error('name') is-invalid @enderror" id="name"
                value="{{old('name')}}" placeholder="name">
            @error('name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection