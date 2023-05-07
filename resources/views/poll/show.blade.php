@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">{{$poll->name}}</h1>
            <a class="btn btn-sm btn-success float-end" href="{{route('poll.entity.edit', $poll->id)}}" role="Button">Edit</a>
        </div>
    </div>

    <div class="card">
        @foreach ($poll->questions as $question)
            <div class="mb-3">
                {{$question->title}}:
                <strong>{{$question->total}}</strong>
            </div>
        @endforeach

    </div>

@endsection
