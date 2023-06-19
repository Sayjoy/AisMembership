@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">{{$user->name}} Profile</h1>
            <a class="btn btn-sm btn-success float-end" href="{{route('user.profile.edit', $user->id)}}" role="Button">Edit</a>
        </div>
    </div>

    <div class="card">
        <div class="row">
            <div class="col-md-2">
                <img class="img-fluid" src="{{$user->profilePhoto()}}">
            </div>
            <div class="col-md-10">
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
                    <strong for="country" class="form-label">Highest Education</strong>:
                    {{$user->highestEducation()}}
                </div>

                <div class="mb-3">
                    <strong for="country" class="form-label">Workgroups</strong>:
                    <ul>
                        @foreach ($user->workgroups as $workgroup)
                            <li>{{$workgroup->name}}</li>
                        @endforeach
                    </ul>
                </div>

                <div class="mb-3">
                    <strong for="expertise" class="form-label">Areas of Expertise</strong>:
                    {{$user->expertise}}
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
        </div>
    </div>

@endsection
