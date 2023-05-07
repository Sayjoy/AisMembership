@extends('templates.main')

@section('content')
    <h1>Edit Poll: {{$poll->name}}</h1>
    <div class="card">
    <form method="POST" action="{{route('poll.entity.update', $poll->id)}}">
        @method('PATCH')
        @include('poll.partials.poll-form', [
            'poll' => $poll,
            'edit' => True
        ])
    </form>
    </div>
@endsection
