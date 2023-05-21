<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
    <head>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <meta name="csrf-token" content="{{ csrf_token() }}">

        <title>{{ config('app.name', "AIS Membership App")}}</title>

       <!-- Styles -->
        <link href="{{ asset('css/app.css')}}" rel="stylesheet">

        <!---JS -->
        <script src="{{ asset('js/app.js')}}" defer></script>
    </head>
    <body>
        <nav class="navbar navbar-expand-lg">
            <div class="container">
              <a class="navbar-brand" href="#">{{ config('app.name', "AIS Membership App")}}</a>
              <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
              </button>

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link" href="{{ url('https://newnigeriadiaspora.com/')}}">Main site</a>
                    </li>
                    <li class="nav-item">
                    <a class="nav-link" href="{{ url('/policy-ideas')}}">Policy Ideas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('policies.published')}}">Published Policies</a>
                  </li>
                </ul>
              </div>


                <div class="d-flex" role="search">
                    @if (Route::has('login'))
                    <div>
                        @auth
                            <a href="{{ route('user.profile.show', auth()->User()->id) }}">Profile</a>
                            <a href="{{ route('logout') }}"
                                onclick="event.preventDefault();
                                        document.getElementById('logout-form').submit()">
                            Logout</a>

                            <form id="logout-form" action="{{ route ('logout')}}" method="POST" style="display: none">
                                @csrf
                            </form>
                        @else
                            <a href="{{ route('login') }}">Log in</a>

                            @if (Route::has('register-form'))
                                <a href="{{ route('register-form') }}" >Register</a>
                            @endif
                        @endauth
                    </div>
                    @endif
              </div>
            </div>
        </nav>

        @can('logged-in')
        <nav class="navbar sub-nav navbar-expand-lg">
            <div class="container">

              <div class="collapse navbar-collapse" id="navbarSupportedContent">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/')}}">Home</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link active" aria-current="page" href="{{ url('/discuss')}}">Policy Discuss</a>
                  </li>
                  @can('is-admin')
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('admin.users.index')}}">Members</a>
                  </li>
                  @endcan
                  @can('is-admin-moderator')
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('policy.ideas.index')}}">Submited Ideas</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('policy.category.index')}}">Policy Categories</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('poll.entity.create')}}">Create Poll</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link" href="{{ route('poll.entity.index')}}">Poll List</a>
                  </li>
                  @endcan
                </ul>
              </div>
            </div>
        </nav>
        @endcan

        <main class="container">
            @include('partials.alerts')
            @yield('content')
        </main>
    </body>

</html>
