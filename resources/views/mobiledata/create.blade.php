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


    <form action="{{route('mobiledata.store')}}" method="POST">
        @csrf
        <div class="mb-3">
            <label for="company_name" class="form-label">Company</label>
            <select class="form-select" name="company_name" id="company_name">
                <option value="">Select</option>
                @foreach ($Companies as $Company)
                <option value="{{$Company->id}}" {{ ($Company->id == $Group->user_id ? 'selected':'') }}>
                    {{$Company->company_name}}</option>
                @endforeach
            </select>
            @error('company_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="group_name" class="form-label">Group</label>
            <select class="form-select" name="group_name" id="group_name">
                <option value="">Select</option>
                @foreach ($Groups as $Group)
                <option value="{{$Group->id}}" {{ ($Group->id == old('group_name') ? 'selected':'') }}>
                    {{$Group->name}}</option>
                @endforeach
            </select>
            @error('group_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="section_name" class="form-label">Section</label>
            <select class="form-select" name="section_name" id="section_name">
                <option value="">Select</option>
                @foreach ($Sections as $Section)
                <option value="{{$Section->id}}" {{ ($Section->id == old('section_name') ? 'selected':'') }}>
                    {{$Section->name}}</option>
                @endforeach
            </select>
            @error('section_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="first_name" class="form-label">First Name</label>
            <input type="text" name="first_name" class="form-control @error('first_name') is-invalid @enderror" id="first_name"
                value="{{old('first_name')}}" placeholder="Frsit Name">
            @error('first_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="last_name" class="form-label">Last Name</label>
            <input type="text" name="last_name" class="form-control @error('first_name') is-invalid @enderror" id="last_name"
                value="{{old('last_name')}}" placeholder="Last Name">
            @error('last_name')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="parent_mobile_1" class="form-label">Parent Mobile 1</label>
            <input type="text" name="parent_mobile_1" class="form-control" id="parent_mobile_1" value="{{old('parent_mobile_1')}}"
                placeholder="923001234567">
            @error('parent_mobile_1')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="parent_mobile_2" class="form-label">Parent Mobile 2</label>
            <input type="text" name="parent_mobile_2" class="form-control" id="parent_mobile_2"
                value="{{old('parent_mobile_2')}}" placeholder="923001234567">
            @error('parent_mobile_2')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="student_mobile_1" class="form-label">Student Mobile 1</label>
            <input type="text" name="student_mobile_1" class="form-control" id="student_mobile_1"
                value="{{old('student_mobile_1')}}" placeholder="923001234567">
            @error('student_mobile_1')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <div class="mb-3">
            <label for="student_mobile_2" class="form-label">Student Mobile 2</label>
            <input type="text" name="student_mobile_2" class="form-control" id="student_mobile_2"
                value="{{old('student_mobile_2')}}" placeholder="923001234567">
            @error('student_mobile_2')
            <span class="text-danger">{{$message}}</span>
            @enderror
        </div>
        <button type="submit" class="btn btn-primary">Submit</button>
    </form>
</div>

@endsection