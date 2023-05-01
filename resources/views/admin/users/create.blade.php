@extends('templates.main')

@section('content')
    <h1>Create New User</h1>
    <div class="card">
    <form method="POST" enctype="multipart/form-data" action="{{route('admin.users.store')}}">
        @include('auth.partials.form', ['actor' => 'admin', 'action' => 'register'])
    </form>
    </div>
@endsection
