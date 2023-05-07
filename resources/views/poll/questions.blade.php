@extends('templates.main')

@section('content')
    <h1>Poll Questions - {{$poll->name}}</h1>
    <div class="card">
    <form method="POST" action="{{route('poll.questions.store')}}">
        @include('poll.partials.poll-questions-form',[
            'poll' => $poll,
            'q_no' => $q_no
        ])
    </form>
    </div>
@endsection
