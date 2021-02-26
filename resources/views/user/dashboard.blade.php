<h1>Dashboard</h1>
@if (Session::get('user_id') && Session::get('company_nature'))
<p>{{Session::get('user_id') }} - {{ Session::get('company_nature')}}</p>
<p>{{$User['first_name']}} - {{$User['last_name']}}</p>

@endif