@extends('templates.main')

@section('content')
    <h1>Update profile</h1>
    {{--  <form method="POST" action="{{route('user-profile-information.update')}}">  --}}
    <form method="POST" enctype="multipart/form-data" action="{{route('user.profile.update', $user->id)}}">
        @csrf
        @method("PUT")
        @include('auth.partials.form', ['actor' => 'self', 'action' => 'edit'])

      </form>
@endsection
