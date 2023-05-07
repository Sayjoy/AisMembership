@extends('templates.main')

@section('content')
    <h1>Edit Poll Questions - {{$poll->name}}</h1>
    <div class="card">
    <form method="POST" action="{{route('poll.questions.update', $poll->id)}}">
        @method('PATCH')
        @include('poll.partials.poll-questions-form',[
            'poll' => $poll,
            'q_no' => $q_no,
            'edit' => "Yes"
        ])
    </form>
    </div>
@endsection
