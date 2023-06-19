{{--
    * a actor variable is defined from the parent page.
        - actor value are self, admin
    * An action variable is defined from the parent page:
        - action values are: register, edit.
    * If a user is being created/edited by an admin,
        - set a dummy password
        - No image upload
        - Allow to set country
    * If the user is self registering,
        - allow to set preferred Password
        - allow image upload
        - set country from IP address
    * If user is being edited,
        - do not allow password access
        - self editing user should not be able to change email
    * The admin uses the UserController
    * Self registration uses fortify action: app\Actions\Fortify\CreateNewUser.php
    * Self update uses the ProfileController
--}}

@csrf

@isset($user)
    @php
        $education = $user->educationLevels;
    @endphp
@endisset
<div class="mb-3">
  <label for="name" class="form-label">name</label>
  <input name="name" type="text" class="form-control @error('name') is-invalid @enderror" id="name" aria-describedby="name"
        value="{{old('name')}}@isset($user){{ $user->name}}@endisset">
  @error('name')
    <span class="invalid-feedback" role="alert">
        {{$message}}
    </span>
  @enderror
</div>
@if ($action == "register" || $actor == "admin")
{{--  Emails are only available at registration or if an admin is editing the page.  --}}
    <div class="mb-3">
        <label for="email" class="form-label">Email Address (Use a valid Email, a validation link will be sent to the email you provide) </label>
        <input name="email" type="email" class="form-control @error('email') is-invalid @enderror" id="email" aria-describedby="email"
                value="{{old('email')}}@isset($user){{ $user->email}}@endisset">
        @error('email')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
        @enderror
    </div>
@endif

<div class="mb-3">
    <label for="phone" class="form-label">Phone Number</label>
    <input name="phone" type="text" class="form-control @error('phone') is-invalid @enderror" id="phone" aria-describedby="phone"
            value="{{old('phone')}}@isset($user){{ $user->phone}}@endisset">
    @error('phone')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="education" class="form-label">Highest Educational Qualification</label>
    <select name="education" class="form-control @error('education') is-invalid @enderror" id="education">
        @foreach ($education as $key=>$value)
           <option value="{{$key}}"
            @if (old('education')==$value || isset($user->education)==$key)
                selected
            @endif
            >{{$value}}</option>
        @endforeach
    </select>
    @error('education')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="phone" class="form-label">Areas of Expertise</label>
    <input name="expertise" type="text" class="form-control @error('expertise') is-invalid @enderror" id="expertise" aria-describedby="expertise"
            value="{{old('expertise')}}@isset($user){{ $user->expertise}}@endisset">
    @error('expertise')
        <span class="invalid-feedback" role="alert">
            {{$message}}
        </span>
    @enderror
</div>

<div class="mb-3">
    <label for="workgroup" class="form-label">Choose atleast one Workgroup</label>
    @foreach ($workgroups as $workgroup)
        <div class="form-check">
            <input class="form-check-input" name="workgroup[]"
                type="checkbox" value="{{$workgroup->id}}" id="{{$workgroup->name}}"
                @isset($user)
                    @if (in_array($workgroup->id, $user->workgroups->pluck('id')->toArray()))
                        checked
                    @endif
                @endisset >
            <label class="form-check-label" for="{{$workgroup->name}}">
                {{$workgroup->name}}
            </label>
        </div>
    @endforeach
</div>

@if ($actor == "self")
{{--  A user is self acting  --}}
{{--  Allow profile image upload --}}
<div class="mb-3">
    <label for="formFile" class="form-label">Upload Profile Picture</label>
    <input class="form-control" name="picture" type="file" id="formFile">
    @error('picture')
            <span class="invalid-feedback" role="alert">
                {{$message}}
            </span>
    @enderror
</div>

    @if ($action == "register")
    {{--  A self registering user: allow password set  --}}
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
        @isset($ipAddress)
            <input type="hidden" name="ip" value="{{$ipAddress}}">
        @endisset

    @endif

@elseif ($actor == "admin")
{{--  Admin acting: No paswords  --}}
    {{--  <input name="password" type="hidden" value="dummypass12345%$#">
    <input name="password_confirmation" type="hidden" value="dummypass12345%$#">  --}}

    {{--  Set Country and roles  --}}
    <div class="mb-3">
        <label for="country" class="form-label">Country</label>
        <select name="country" class="form-control @error('country') is-invalid @enderror" id="country">
            @foreach ($countries as $country)
               <option value="{{$country}}"
                @if (old('country')==$country)
                    selected
                @endif
                @isset($user)
                    @if($user->country==$country)
                        selected
                    @endif
                @endisset
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

@endif

<button name="submit" type="submit" class="btn btn-primary">Submit</button>
