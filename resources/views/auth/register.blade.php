@extends('templates.main')

@section('content')
    {{--  User self registrations  --}}
    <h1>Register</h1>
    <form method="POST" enctype="multipart/form-data" action="{{route('register')}}">
        @csrf

        @include('auth.partials.form', ['actor' => 'self', 'action' => 'register', 'ipAddress' => $ipAddress])
        {{--  <div class="mb-3">
          <label for="name" class="form-label">name</label>
          <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name" value="{{old('name')}}">
          @error('name')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
          @enderror
        </div>
        <div class="mb-3">
            <label for="email" class="form-label">email</label>
            <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email" value="{{old('email')}}">
            @error('email')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">Phone Number</label>
            <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" aria-describedby="phone" value="{{old('phone')}}">
            @error('phone')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
            @enderror
        </div>

        <div class="mb-3">
          <label for="password" class="form-label">Password</label>
          <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password" value="{{old('password')}}">
          @error('password')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
          @enderror
        </div>
        <div class="mb-3">
            <label for="password_confirmation" class="form-label">Password Confirm</label>
            <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation" value="{{old('passowrd_confirmation')}}">
            @error('password_fortify')
                <span class="invalid-feedback" role="alert">
                    {{$message}}
                </span>
            @enderror
          </div>

          <input type="hidden" name="ip" value="{{$ipAddress}}">
        <button name="submit" type="submit" class="btn btn-primary">Submit</button>  --}}
      </form>
@endsection
