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
                    <th scope="col">Full Name</th>
                    <th scope="col">Email</th>
                    <th scope="col" style="width: 10%;" class="text-center"><a href="{{ route('users.create') }}"><i
                                class="fas fa-plus" style="color: white">+</i></a>
                    </th>
                </tr>
            </thead>

            <tbody>
                @foreach ($Users as $User)
                <tr>
                    <td class="align-middle">{{ $User->first_name }} {{ $User->last_name }}</td>
                    <td class="align-middle">{{ $User->email }}</td>
                    <td class="link text-center align-middle">
                        <a class="btn btn-UNi float-left" href="{{ route('users.edit', ['user' => $User->id]) }}"><i
                                class="fas fa-pen-fancy">asd</i></a>
                        <form method="POST" action="{{ route('users.destroy', ['user' => $User->id]) }}">
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