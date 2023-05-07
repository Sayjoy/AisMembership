@extends('templates.main')

@section('content')
    <h1>Create a Poll</h1>
    <div class="card">
    <form method="POST" action="{{route('poll.entity.store')}}">
        @include('poll.partials.poll-form')
    </form>
    </div>
@endsection
