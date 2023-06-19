@extends('templates.main')

@section('content')
    {{--  User self registrations  --}}
    <h1>Register</h1>
    <form method="POST" enctype="multipart/form-data" action="{{route('register')}}">
        @csrf

        @include('auth.partials.form', ['actor' => 'self', 'action' => 'register', 'ipAddress' => $ipAddress])

      </form>
@endsection
