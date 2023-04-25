@extends('templates.main')

@section('content')

    <div class="row">
        <div class="col-12">
            <h1 class="btm_margin float-start">Policies Submited @isset($category)
                - {{$category->name}}
            @endisset</h1>
        </div>
    </div>

    <div class="card">
        <table class="table">
            <thead>
              <tr>
                <th scope="col">Id</th>
                <th scope="col">Title</th>
                <th scope="col">Details</th>
                <th scope="col">Submited By</th>
                <th scope="col">Categories</th>
                <th scope="col">Action</th>
              </tr>
            </thead>
            <tbody>
                @foreach ($policies as $policy)
                <tr>
                    <th scope="row">{{$policy->id}}</th>
                    <td><a href="{{ route('policy.show', $policy->id)}}">{{$policy->title}}</a></td>
                    <td>{!!$policy->shortDetails()!!}</td>
                    <td>@if ($policy->user_id)
                            {{$policy->user->name}} (Member), <br/>
                            {{$policy->user->email}}, <br/>
                            {{$policy->user->phone}},
                        @else
                            {{$policy->name}} (Guest), </br>
                            {{$policy->email}}, </br>
                            {{$policy->phone}}
                        @endif
                    </td>
                    <td>@foreach ($policy->categories as $category)
                            {{$category->name}}
                        @endforeach
                    </td>
                    <td><p class="m-0 p-0">
                            <!--Actions -->
                            @include('policy.partials.policy-actions', ['policy' => $policy, 'comment'=> true])
                            <!--action ends -->
                        </p>
                        <a href="{{route('policy.ideas.edit', $policy->id)}}" class="btn btn-sm btn-info">Edit</a>
                        <button type="button" class="btn btn-sm btn-danger"
                                onclick="event.preventDefault();
                                document.getElementById('delete-policy-form-{{ $policy->id }}').submit()">
                            Delete
                        </button>
                        <form id="delete-policy-form-{{ $policy->id }}" action="{{ route('policy.ideas.destroy', $policy->id)}}" method="POST" style="display:none">
                            @csrf
                            @method("DELETE")
                        </form>

                    </td>
                  </tr>
                @endforeach
            </tbody>
          </table>
          {{$policies->links()}}
    </div>

@endsection
