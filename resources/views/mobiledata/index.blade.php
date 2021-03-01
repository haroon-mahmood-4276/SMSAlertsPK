@extends('shared.layout')

@section('PageTitle', 'User List')


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


    <div class="table-responsive-md">
        <table class="table table-hover">

            <thead>
                <tr class="bg-UNi">
                    <th scope="col">Company Name</th>
                    <th scope="col">Group Name</th>
                    <th scope="col">Section Name</th>
                    <th scope="col">Name</th>
                    <th scope="col">Student Mobile 1</th>
                    <th scope="col">Student Mobile 2</th>
                    <th scope="col">Parent Mobile 1</th>
                    <th scope="col">Parent Mobile 2</th>
                    <th scope="col" style="width: 10%;" class="text-center"><a href="{{ route('data.create') }}"><i
                                class="fas fa-plus">+</i></a>
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($MobileDatas as $MobileData)
                <tr>
                    <td class="align-middle">{{ $MobileData->company_name }}</td>
                    <td class="align-middle">{{ $MobileData->group_name }}</td>
                    <th class="align-middle">{{ $MobileData->section_name }}</th>
                    <th class="align-middle">{{ $MobileData->first_name }} {{ $MobileData->last_name }}</th>
                    <th class="align-middle">{{ $MobileData->student_mobile_1 }}</th>
                    <th class="align-middle">{{ $MobileData->student_mobile_2 }}</th>
                    <th class="align-middle">{{ $MobileData->parent_mobile_1 }}</th>
                    <th class="align-middle">{{ $MobileData->parent_mobile_2 }}</th>
                    <td class="link text-center align-middle">
                        <a class="btn btn-UNi float-left"
                            href="{{ route('data.edit', ['data' => $MobileData->id]) }}"><i
                                class="fas fa-pen-fancy">asd</i></a>
                        <form method="POST" action="{{ route('data.destroy', ['data' => $MobileData->id]) }}">
                            @csrf
                            @method('DELETE')
                            <button type="submit" onclick="return confirm('Are you sure?')"
                                class="btn btn-danger float-right"><i class="far fa-trash-alt"></i></button>
                        </form>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>

@endsection