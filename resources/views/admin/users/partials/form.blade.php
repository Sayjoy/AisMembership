@csrf
<div class="mb-3">
  <label for="name" class="form-label">name</label>
  <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name"
        value="{{old('name')}} @isset($user) {{ $user->name}} @endisset">
  @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
  @enderror
</div>
<div class="mb-3">
    <label for="email" class="form-label">Email Address</label>
    <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email"
            value="{{old('email')}} @isset($user) {{ $user->email}} @endisset">
    @error('email')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
  </div>

  <div class="mb-3">
    <label for="phone" class="form-label">Phone Number</label>
    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" aria-describedby="phone"
            value="{{old('phone')}} @isset($user) {{ $user->phone}} @endisset">
    @error('phone')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>
<input name="password" type="hidden" value="dummypass12345%$#">
@error('password')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror

    @error('password_confirmation')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
@enderror
<input name="password_confirmation" type="hidden" value="dummypass12345%$#">
{{--  @isset($create)
    <div class="mb-3">
    <label for="password" class="form-label">Password</label>
    <input name="password" type="password" class="form-control @error('password') is-invalid @enderror" id="password"
            value="{{old('password')}}">
    @error('password')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
    </div>
    <div class="mb-3">
        <label for="password_confirmation" class="form-label">Password Confirm</label>
        <input name="password_confirmation" type="password" class="form-control @error('password_confirmation') is-invalid @enderror" id="password_confirmation"
                value="{{old('password_confirmation')}}">
        @error('password_confirmation')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
        @enderror
        </div>
@endisset  --}}
@empty($profile)

<div class="mb-3">
    <label for="country" class="form-label">Country</label>
    <select name="country" class="form-control @error('country') is-invalid @enderror" id="country">
        @foreach ($countries as $country)
           <option value="{{ $country}}"
            @if (old('country')==$country || isset($user->country)==$country)
                selected
            @endif
            >{{$country}}</option>
        @endforeach
    </select>
    @error('country')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
  </div>

<div class="mb-3">
    @foreach ($roles as $role)
        <div class="form-check">
            <input class="form-check-input" name="roles[]"
                type="checkbox" value="{{$role->id}}" id="{{$role->name}}"
                @isset($user)
                    @if (in_array($role->id, $user->roles->pluck('id')->toArray()))
                        checked
                    @endif
                @endisset >
            <label class="form-check-label" for="{{$role->name}}">
                {{$role->name}}
            </label>
        </div>
    @endforeach
</div>
@endempty
<button name="submit" type="submit" class="btn btn-primary">Submit</button>
