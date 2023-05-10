@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Poll List</h1>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Name</th>
                <th scope="col">Questions</th>
                <th scope="col">Votes</th>
                <th scope="col">Author</th>
                <th scope="col">Status</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @php($i = 0)
                @foreach ($polls as $poll)
                <tr>
                    <th scope="row">{{++$i}}</th>
                    <td><a href="{{ route('poll.entity.show', $poll->id)}}">{{$poll->name}}</a></td>
                    <td>{{$poll->questions->count()}}</td>
                    <td>{{$poll->totalVote()}}</td>
                    <td>{{$poll->author->name}}</td>
                    <td>{{$poll->state()}}</td>
                    <td><a class="btn btn-sm btn-primary" href="{{route('poll.entity.edit', $poll->id)}}" role="Button">Edit</a>
                        <button type="button" class="btn btn-danger"
                                onclick="event.preventDefault();
                                document.getElementById('delete-user-form-{{ $poll->id }}').submit()">
                            Delete
                        </button>
                        <form id="delete-user-form-{{ $poll->id }}" action="{{ route('poll.entity.destroy', $poll->id)}}" method="POST" style="display:none">
                            @csrf
                            @method("DELETE")
                        </form></td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          {{$polls->links()}}
    </div>

@endsection
