@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Your Profile</h1>
            <a class="btn btn-sm btn-success float-end" href="{{route('user.profile.edit', $user->id)}}" role="Button">Edit</a>
        </div>
    </div>

    <div class="card">
        <div class="mb-3">
            <strong for="name" class="form-label">name</strong>:
            {{$user->name}}
        </div>
        <div class="mb-3">
            <strong for="email" class="form-label">Email Address</strong>:
            {{$user->email}}
        </div>

        <div class="mb-3">
            <strong for="country" class="form-label">Country</strong>:
            {{$user->country}}
        </div>

        <div class="mb-3">
            <strong for="phone" class="form-label">Phone Number</strong>:
            {{$user->phone}}
        </div>

        <div class="mb-3">
            <strong for="phone" class="form-label">Role</strong>:
            @foreach ($user->roles as $role)
                {{$role->name}}
            @endforeach
        </div>
    </div>

@endsection
