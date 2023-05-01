@extends('templates.main')

@section('content')
    <h1>Edit Member Details</h1>
    <div class="card">
    <form method="POST" enctype="multipart/form-data" action="{{route('admin.users.update', $user->id)}}">
       @method('PATCH')
       @include('auth.partials.form', ['actor' => 'admin', 'action' => 'edit'])
    </form>
    </div>
@endsection
