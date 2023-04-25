@extends('templates.main')

@section('content')
    <h1>Update profile</h1>
    {{--  <form method="POST" action="{{route('user-profile-information.update')}}">  --}}
    <form method="POST" action="{{route('user-profile-information.update')}}">
        @csrf
        @method("PUT")
        @include('admin.users.partials.form', ['profile'=>true])
        {{--  <div class="mb-3">
          <label for="name" class="form-label">name</label>
          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" value="{{ auth()->user()->name}}">
          @error('name')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
          @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{ auth()->user()->email}}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
            @enderror
        </div>

        <button name="submit" type="submit" class="btn btn-primary">Submit</button>  --}}
      </form>
@endsection
